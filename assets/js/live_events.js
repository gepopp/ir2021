import Axios from "axios";
import moment from "moment";

const Api = Axios.create({
    baseURL: mynamespace.rootapiurl,
    headers: {
        'content-type': 'application/json',
        'X-WP-Nonce': mynamespace.nonce
    }
});


window.addComment = function (user, post) {
    return {
        showAll: false,
        isLoading: true,
        comment: '',
        commentError: false,
        addAnswer: false,
        answer: '',
        comments: [],
        children: [],
        user: user,
        post: post,
        openAnswer(comment) {

            for (var i = 1; i <= comment.child_count; i++) {
                this.children.push({
                    id: false,
                    author_avatar_urls: {48: ''},
                    date: '',
                    content: {
                        rendered: ''
                    }
                });
            }

            this.addAnswer = comment.id;
            Api.get('/wp/v2/comments?order=asc&post=' + this.post + '&parent=' + comment.id).then((rsp) => this.children = rsp.data);


        },
        validate(parent = null) {

            this.commentError = false;

            if (this.comment == '' && this.answer == '') return;


            Api.post('/wp/v2/comments', {
                author: this.user,
                content: !this.addAnswer ? this.comment : this.answer,
                post: this.post,
                parent: parent,
                status: 'approved',
            }).then((response) => {
                console.log('hier');
                this.comment = '';
                this.answer = '';
                this.loadComments();
                if (parent !== null) {
                    Api.get('/wp/v2/comments?order=asc&post=' + this.post + '&parent=' + parent).then((rsp) => this.children = rsp.data);
                }
            }).catch((err) => {
                this.commentError = err.response.data.message;
            });
        },
        init() {

            this.loadComments();
            setInterval(() => {
                this.loadComments();
            }, 5000)
        },
        loadComments() {
            Api.get('/wp/v2/comments?post=' + this.post + '&parent=0')
                .then((rsp) => this.comments = rsp.data)
                .catch()
                .then(() => this.isLoading = false);
        },
        formatDate(date) {
            return new moment(date).format('DD.MM.YY HH:MM');
        }
    }
}
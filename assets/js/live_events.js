import Axios from "axios";
import moment from "moment";

const Api = Axios.create({
    baseURL: mynamespace.rootapiurl,
    headers: {
        'content-type': 'application/json',
        'X-WP-Nonce': mynamespace.nonce
    }
});



window.addComment = function (user, post){
    return {
        comment: '',
        commentError: false,
        addAnswer: false,
        answer: '',
        comments: [],
        user: user,
        post: post,
        validate(parent = null){

            this.commentError = false;

            if(this.comment == '' && this.answer == '') return;


            Api.post('/wp/v2/comments', {
                author: this.user,
                content: !this.addAnswer ? this.comment : this.answer,
                post: this.post,
                parent: parent,
                status: "approved"
            }).then( (response) => {
                this.loadComments()
            }).catch((err) => {
                this.commentError = err.response.data.message;
            }).then(()=> this.comment = this.answer = '', this.addAnswer = false);
        },
        init(){

            this.loadComments();

            // setInterval(()=> {
            //     this.loadComments();
            // }, 3000)
        },
        loadComments(){
            Api.get('/wp/v2/comments?post=' + this.post + '&parent=0').then((rsp) => this.comments = rsp.data);
        },
        formatDate(date){
            return new moment(date).format('DD.MM.YY HH:MM');
        }
    }
}
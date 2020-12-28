const axios = require('axios');

window.alterEmail = function (old) {
    return{
        email: '',
        pin: '',
        oldEmail: old,
        pinSent: false,
        errors:{
            email: false,
            pin: false
        },
        ValidateEmail() {
            this.errors.email = false;

            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(this.email)) {

                var params = new URLSearchParams();
                params.append('action', 'user_exists');
                params.append('email', this.email);

                axios.post(window.ajaxurl, params)
                    .then((rsp) => {
                        this.errors.email = "Diese Email Adresse ist bereits in Verwendung.";
                    })
                    .catch((err) => {
                        this.SendPin();
                        this.errors.email = false;
                    });
            } else {
                this.errors.email = "Bitte eine gültige E-Mail Adresse eingeben.";
            }
        },
        SendPin(){
            var params = new URLSearchParams();
            params.append('action', 'send_email_pin');
            params.append('email', this.email);
            params.append('old_email', this.oldEmail);

            axios.post(window.ajaxurl, params)
                .then((rsp) => {
                    this.pinSent = true;
                })
                .catch((err) => {
                    this.errors.email = err.response;
                });
        },
        ValidatePin(){

            this.errors.pin = false;

            var params = new URLSearchParams();
            params.append('action', 'validate_pin');
            params.append('pin', this.pin);
            params.append('old_email', this.oldEmail);
            params.append('email', this.email);

            axios.post(window.ajaxurl, params)
                .then((rsp) => {
                    window.location.reload();
                })
                .catch((err) => {
                    this.errors.pin = err.response.data;
                });
        }
    }
}
window.logs = function (log, logs, all, user_id){
    return {
        logs: logs,
        log_name: log,
        user_id: user_id,
        all: all,
        modalOpen: false,
        editReminder: {},
        remindInDays: 3,
        loadNext(){

            var params = new URLSearchParams();
            params.append('action', 'load_log');
            params.append('log', this.log_name);
            params.append('offset', this.logs.length);
            params.append('user_id', this.user_id);

            axios.post(window.ajaxurl, params)
                .then((rsp) => {
                    rsp.data.map((log) => this.logs.push(log))
                })
                .catch((err) => {

                });
        },
        removeBookmark(id){
            var params = new URLSearchParams();
            params.append('action', 'remove_user_bookmark');
            params.append('id', id);

            axios.post(window.ajaxurl, params)
                .then((rsp) => {
                    for(i = 0; i < this.logs.length; i++){
                        if(this.logs[i].id == id){
                            this.logs.splice(i, 1);
                        }
                    }
                })

        },
        updateReminder(log){
            this.editReminder = log;
            this.modalOpen = true;
        },
        setReminder(){
            var params = new URLSearchParams();
            params.append('action', 'update_reminder_date');
            params.append('id', this.editReminder.id);
            params.append('days', this.remindInDays);

            axios.post(window.ajaxurl, params)
                .then((rsp) => {

                    for( i = 0; i < this.logs.length; i++){
                        if( this.logs[i].id == this.editReminder.id ){
                            this.logs[i].time = rsp.data.time;
                            this.logs[i].date = rsp.data.remind_at;
                        }
                    }

                    this.editReminder = {};
                    this.modalOpen = false;

                })
        }
    }
}




const axios = require('axios');

window.loginForm = function (email, global) {
    return {
        email: email,
        password: '',
        remember: false,
        completed: false,
        error: {
            email: false,
            password: false,
            global: global,
        },
        ValidateEmail() {
            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(this.email)) {
                var params = new URLSearchParams();
                params.append('action', 'user_exists');
                params.append('email', this.email);

                axios.post(window.ajaxurl, params)
                    .then((rsp) => {
                        this.error.email = false;
                        this.checkCompleted();
                    })
                    .catch((err) => {
                        this.error.email = "Diese E-Mail Adresse ist nicht registriert.";
                        this.checkCompleted();
                    });
            } else {
                this.error.email = "Bitte eine gültige E-Mail Adresse eingeben.";
                this.checkCompleted();
            }
        },
        checkCompleted() {

            if (this.email == '' || this.password == '' || this.error.email != false) {
                this.completed = false;
            } else {
                this.completed = true;
            }

        },
        resendConfirmation(email) {

            if (this.email != '') {

                var params = new URLSearchParams();
                params.append('action', 'resend_confirmation_email');
                params.append('email', email);

                axios.post(window.ajaxurl, params)
                    .then((rsp) => {
                        this.error.global = "Wir haben Ihnen ein E-Mail gesendet, bitte überprüfen Sie Ihren Posteingang.";
                    })
                    .catch((err) => {
                        this.error.global = err.data;
                    });
            }
        }
    }
}

window.registerForm = () => {
    return {
        regsiter_gender:'',
        regsiter_firstname: '',
        regsiter_lastname:'',
        regsiter_email:'',
        regsiter_password:'',
        regsiter_errors:{
            gender:false,
            firstname:false,
            lastname:false,
            email:false,
            password:false
        },
        validate(){

            console.log(this.regsiter_gender)

            if(this.regsiter_gender == ''){
                this.regsiter_errors.gender = 'Bitte wählen';
            }


        }
    }
}
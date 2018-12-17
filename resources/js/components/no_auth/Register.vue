<template>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4 offset-md-3 offset-lg-4">
            <h1>Register</h1>
            <div class="card">
                <div class="card-body">
                    <div v-if="registration_success">
                        <p>Registration complete!</p>
                        <p>You will receive an email at {{ user.email }} with an activation link. Click on that link to activate and you will be able to log in.</p>
                    </div>
                    <form @submit.prevent="register" v-else>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" v-model="user.first_name" />
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" v-model="user.last_name" />
                                </div>
                                <div class="form-group">
                                    <label>Email Address <small>(Username)</small></label>
                                    <input type="text" class="form-control" v-model="user.email" @blur="userExists" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <vue-password v-model="user.password" :user-inputs="[user.email]"></vue-password>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" v-model="user.password_confirm" />
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import VuePassword from 'vue-password'
export default {
    data() {
        return {
            user: {}
        }
    },
    components: {
        VuePassword
    },
    computed: {
        registration_success() {
            return this.$store.getters.registration_success;
        }
    },
    methods: {
        register() {
            if (this.validUser()) {
                let params = {
                    'first_name': this.user.first_name,
                    'last_name': this.user.last_name,
                    'email': this.user.email,
                    'password': this.user.password
                };
                this.$store.dispatch("userRegister",params);
            }
        },
        userExists() {
            if (!this.user.email || this.user.email === '') { return; }
            let params = {
                'email': this.user.email
            };
            this.$store.dispatch("userExists",params);
        },
        validUser() {
            let u = this.user;
            this.$store.commit("error_message","");
            if (!u.first_name || u.first_name === '') {
                this.$store.commit("error_message","First Name is required.");
                return false;
            }
            if (!u.last_name || u.last_name === '') {
                this.$store.commit("error_message","Last Name is required.");
                return false;
            }
            if (!u.email || u.email === '') {
                this.$store.commit("error_message","Email Address is required.");
                return false;
            }
            if (!u.password || u.password === '') {
                this.$store.commit("error_message","Password is required.");
                return false;
            }
            if (u.password !== u.password_confirm) {
                this.$store.commit("error_message","Passwords do not match.");
                return false;
            }
            return true;
        }
    }
}
</script>
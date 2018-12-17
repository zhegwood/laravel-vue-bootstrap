<template>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4 offset-md-3 offset-lg-4">
            <h1>Login</h1>
            <div class="card">
                <div class="card-body">
                    <div v-if="activation">
                        <div class="alert alert-success">
                            <span>Activation Success!  You man now log in.</span>
                        </div>
                    </div>
                    <form @submit.prevent="login">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" v-model="user.username" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" v-model="user.password" />
                                </div>
                                <div class="form-check text-right">
                                    <input type="checkbox" class="form-check-input" v-model="user.remember" />
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <p><a href="/register">Register for an Account</a><br/>
                    <a href="/resend">Resend Activation Email</a></p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: {}
        }
    },
    computed: {
        activation() {
            let url = location.href,
                parts = url.split('?');

            if (!parts[1]) { return false; }

            parts = parts[1].split('=');
            if (parts.length === 2 && parts[0] === 'activate' && parts[1] === "true") {
                return true;
            }
            return false;
        }
    },
    methods: {
        login() {
            let params = {
                'username': this.user.username,
                'password': this.user.password,
                'remember': this.user.remember
            }
            this.$store.dispatch("userLogin",params);
        }
    }
}
</script>
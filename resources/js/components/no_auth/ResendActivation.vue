<template>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4 offset-md-3 offset-lg-4">
            <h1>Resend Activation</h1>
            <div class="card">
                <div class="card-body">
                    <div v-if="resend_success">
                        <span>If your email address is found, you will receive another activation link at {{ user.email }}.</span>
                    </div>
                    <div v-else>
                        <resend-form @update-user="updateUser"></resend-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
Vue.component('resend-form', require('../shared/ResendForm.vue'));
export default {
    data() {
        return {
            user: {}
        }
    },
    computed: {
        resend_success() {
            return this.$store.getters.resend_success;
        }
    },
    methods: {
        updateUser(user) {
            this.user = user;
        }
    }
}
</script>
<template>
    <form @submit.prevent="resend">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" v-model="user.email" @input="updateUser" />
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Resend Activation</button>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    data() {
        return {
            user: {}
        }
    },
    methods: {
        resend() {
            if (!this.user.email || this.user.email === '') {
                return;
            }
            let params = {
                'email': this.user.email
            };
            this.$store.dispatch('activationResend',params);
        },
        updateUser() {
            this.$emit('update-user',this.user);
        }
    }
}
</script>
<template>
    <div class="global-error" v-if="error_message !== ''">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 offset-md-3 offset-lg-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ error_message }}
                    <button type="button" class="close" aria-label="Close" @click="clearError">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    computed: {
        error_message() {
            return this.$store.getters.error_message;
        }
    },
    methods: {
        clearError() {
            this.$store.commit('error_message','');
        }
    }
}
</script>
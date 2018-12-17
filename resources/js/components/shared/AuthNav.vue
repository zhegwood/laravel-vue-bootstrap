<template>
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="/">Laravel - Vue - Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" @click="logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    methods: {
        logout() {
            this.$store.dispatch("userLogout");
        }
    }
}
</script>
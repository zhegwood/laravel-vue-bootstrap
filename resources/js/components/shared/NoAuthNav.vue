<template>
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="/">Laravel - Vue - Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" :class="{'active': register_active}">
                    <a class="nav-link" href="/register">Register</a>
                </li>
                <li class="nav-item" :class="{'active': login_active}">
                    <a class="nav-link" href="/login">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    computed: {
        login_active() {
            let url = location.href;
            return url.substring(url.lastIndexOf("/")+1,url.length).indexOf("login") !== -1;
        },
        register_active() {
            let url = location.href;
            return url.substring(url.lastIndexOf("/")+1,url.length).indexOf("register") !== -1;
        }
    }
}
</script>
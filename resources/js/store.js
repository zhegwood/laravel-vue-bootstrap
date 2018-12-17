import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        error_message: "",
        registration_success: false,
        resend_success: false
    },
    getters: {
        error_message(state) {
            return state.error_message;
        },
        registration_success(state) {
            return state.registration_success;
        },
        resend_success(state) {
            return state.resend_success;
        }
    },
    mutations: {
        error_message(state, data) {
            state.error_message = data;
        },
        registration_success(state, data) {
            state.registration_success = data;
        },
        resend_success(state, data) {
            state.resend_success = data;
        }
    },
    actions: {
        activationResend(context,params) {
            context.commit("error_message","");
            axios.post('/api/activation/resend',params).then(
                (response) => {
                    if (!response.data.success) {
                        context.commit('error_message',response.data.error);
                    } else {
                        context.commit('resend_success',true);
                    }
                }
            );
        },
        userExists(context,params) {
            context.commit("error_message","");
            axios.post('/api/user/exists',params).then(
                (response) => {
                    if (!response.data.success) {
                        context.commit('error_message',response.data.error);
                    }
                }
            );
        },
        userLogin(context,params) {
            context.commit("error_message","");
            axios.post('/api/user/login',params).then(
                (response) => {
                    if (!response.data.success) {
                        context.commit('error_message',response.data.error);
                    } else {
                        location.href = '/';
                    }
                }
            );
        },
        userLogout(context) {
            context.commit("error_message","");
            axios.get('/api/user/logout').then(
                (response) => {
                    if (!response.data.success) {
                        context.commit('error_message',response.data.error);
                    } else {
                        location.href = '/';
                    }
                }
            );
        },
        userRegister(context,params) {
            context.commit("error_message","");
            axios.post('/api/user/register',params).then(
                (response) => {
                    if (!response.data.success) {
                        context.commit('error_message',response.data.error);
                    } else {
                        context.commit('registration_success',true);
                    }
                }
            );
        }
    }
  })
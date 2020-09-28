import user from "../../apis/user";

const state = {
    loading: false,
    loginErrors: {},
    loggedInUser: {},
    isLoggedIn: false,
    registerErrors: {},
    isRegistered: false
};

const getters = {
    registerErrors: state => state.registerErrors,
    isRegistered: state => state.isRegistered,
    loggedInUser: state => state.loggedInUser,
    loginErrors: state => state.loginErrors,
    isLoggedIn: state => state.isLoggedIn,
    loading: state => state.loading
};

const actions = {
    clearErrors({ commit }, error) {
        commit("clearErrors", error);
    },

    async register({ commit }, formData) {
        commit("startLoading");

        try {
            await user.register(formData);

            commit("isRegistered");
        } catch (error) {
            if (error.response.status === 422) {
                commit("setRegisterErrors", error.response.data.errors);
            }
        } finally {
            commit("endLoading");
        }
    },

    async login({ commit }, formData) {
        commit("startLoading");

        try {
            const { data } = await user.login(formData);

            localStorage.setItem("token", data.access_token);

            commit("loggedIn");
        } catch (error) {
            if (error.response.status === 422) {
                commit("setLoginErrors", error.response.data.errors);
            }

            localStorage.removeItem("token");
        } finally {
            commit("endLoading");
        }
    },

    async getLoggedInUser({ commit }) {
        commit("startLoading");
        try {
            const { data } = await user.auth();

            commit("loggedIn");

            commit("setLoggedInUser", data);
        } catch (error) {
            // if (error.response.status === 422) {
            //     commit("setErrors", error.response.data.errors);
            // }
            console.error(error);
        } finally {
            commit("endLoading");
        }
    },

    async logout({ commit }) {
        try {
            await user.logout();

            localStorage.removeItem("token");

            commit("loggedOut");
        } catch (error) {
            console.error(error);
        }
    },

    loggedOut({ commit }) {
        commit("loggedOut");
    },

    loggedIn({ commit }) {
        commit("loggedIn");
    }
};

const mutations = {
    loggedIn: state => (state.isLoggedIn = true),
    endLoading: state => (state.loading = false),
    startLoading: state => (state.loading = true),
    isRegistered: state => (state.isRegistered = true),
    clearErrors: (state, error) => (state[error] = {}),
    setLoggedInUser: (state, user) => (state.loggedInUser = user),
    setLoginErrors: (state, errors) => (state.loginErrors = errors),
    setRegisterErrors: (state, errors) => (state.registerErrors = errors),
    loggedOut: state => ((state.isLoggedIn = false), (state.lgggedInUser = {}))
};

export default {
    state,
    getters,
    actions,
    mutations
};

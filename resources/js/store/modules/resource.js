import resourceApi from "../../apis/resource";

const state = {
    oneResource: {},
    isLoading: false,
    allResources: [],
    addResourceErrors: {},
    resourceAdded: false,
    isDeleting: false,
    isAdding: false
};

const getters = {
    oneResource: state => state.oneResource,
    addResourceErrors: state => state.addResourceErrors,
    allResources: state => state.allResources,
    resourceAdded: state => state.resourceAdded,
    isDeleting: state => state.isDeleting,
    isAdding: state => state.isAdding
};

const actions = {
    clearResourceErrors({ commit }) {
        commit("clearAddResourceErrors");
    },

    async addResource({ commit }, formData) {
        commit("addingStart");

        try {
            await resourceApi.add(formData);

            commit("setResourceAdded");
        } catch (error) {
            if (error.response.status === 422) {
                commit("setAddResourceErrors", error.response.data.errors);
            }
        } finally {
            commit("addingEnd");
        }
    },

    async getAllResources({ commit }) {
        commit("asyncStart");

        try {
            const { data } = await resourceApi.getAll();

            commit("setAllResources", data.data);
        } catch (error) {
            console.error(error.response.data);
        } finally {
            commit("asyncEnd");
        }
    },

    async deleteResource({ commit }, id) {
        commit("deletingStart");
        try {
            await resourceApi.delete(id);
        } catch (error) {
            console.error(error.response.data);
        } finally {
            commit("deletingEnd");
        }
    }
};

const mutations = {
    clearAddResourceErrors: state => (state.addResourceErrors = {}),
    setAddResourceErrors: (state, errors) => (state.addResourceErrors = errors),
    asyncEnd: state => (state.loading = false),
    asyncStart: state => (state.loading = true),
    deletingEnd: state => (state.isDeleting = false),
    deletingStart: state => (state.isDeleting = true),
    addingEnd: state => (state.isAdding = false),
    addingStart: state => (state.isAdding = true),
    setAllResources: (state, data) => (state.allResources = data),
    setResourceAdded: state => (state.resourceAdded = true)
};

export default {
    state,
    getters,
    actions,
    mutations
};

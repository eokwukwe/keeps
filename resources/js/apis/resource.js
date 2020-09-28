import api from "./api";

export default {
    add(data) {
        return api().post("/study-materials", data);
    },

    getAll() {
        return api().get("/study-materials");
    },

    getOne(id) {
        return api().get(`/study-materials/${id}`);
    },

    delete(id) {
        return api().delete(`/study-materials/${id}`);
    },

};

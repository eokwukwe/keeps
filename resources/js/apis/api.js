import axios from "axios";

let baseApi = axios.create({
    baseURL: "http://keeps.test/api"
});

let api = function() {
    let token = localStorage.getItem("token");

    if (token) {
        baseApi.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    }

    return baseApi;
};

export default api;

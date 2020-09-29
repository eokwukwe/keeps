import axios from "axios";

let baseApi = axios.create({
    baseURL:
        process.env.NODE_ENV === "development"
            ? "http://keeps.test/api"
            : "https://fcode-larakeeps.herokuapp.com/api"
});

let api = function() {
    let token = localStorage.getItem("token");

    if (token) {
        baseApi.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    }

    return baseApi;
};

export default api;

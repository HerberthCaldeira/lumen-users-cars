import axios from "axios";

const api = axios.create({
    baseURL: process.env.REACT_APP_BASE_URL || "http://car.test:80",
});

export default api;
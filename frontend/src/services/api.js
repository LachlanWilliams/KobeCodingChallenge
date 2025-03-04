import axios from "axios";

// Set up Axios with your API base URL
const apiClient = axios.create({
  baseURL: "http://127.0.0.1:8000", // Adjust if your Laravel is on a different host/port
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
  },
});

export default {
  // Get all vehicle parts
  getParts() {
    return apiClient.get("/api/parts");
  },

  // Get all makes
  getMakes() {
    return apiClient.get("/api/makes");
  },

  // Get models based on a specific make
  getModels(make) {
    return apiClient.get(`/api/models/${make}`);
  },

  // Get types based on make and model
  getTypes(make, model) {
    return apiClient.get(`/api/types/${make}/${model}`);
  },

  // Get parts based on make, model, and type
  getFilteredParts(make, model, type) {
    return apiClient.get(`/api/parts/${make}/${model}/${type}`);
  },
};


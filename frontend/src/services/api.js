import axios from 'axios';

// Set up Axios with your API base URL
const apiClient = axios.create({
  baseURL: 'http://127.0.0.1:8000', // Adjust if your Laravel is on a different host/port
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  },
});

export default {
  getParts() {
    return apiClient.get('/api/parts');
  },
};

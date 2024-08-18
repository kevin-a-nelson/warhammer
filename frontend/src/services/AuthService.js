import axios from 'axios';

const API_URL = 'http://localhost:8000/api'; // Replace with your API URL

class AuthService {
  async login(email, password) {
    try {
      const response = await axios.post(`${API_URL}/login`, {
        email,
        password
      });

      if (response.data.access_token) {
        localStorage.setItem('access_token', JSON.stringify(response.data.access_token));
      }

      return response.data;
    } catch (error) {
      console.error('Error logging in:', error);
      throw error;
    }
  }

  logout() {
    localStorage.removeItem('user');
  }

  getCurrentUser() {
    return JSON.parse(localStorage.getItem('access_token'));
  }
}

export default new AuthService();
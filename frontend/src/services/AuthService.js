import axios from "axios";
import router from "@/router"; // Import the router from your Vue instance

const API_URL = "http://localhost:8000/api"; // Replace with your API URL

class AuthService {
  async login(email, password) {
    try {
      const response = await axios.post(`${API_URL}/login`, {
        email,
        password,
      });

      localStorage.setItem("access_token", response.data.access_token);

      localStorage.setItem("user", JSON.stringify(response.data.user));

      router.push("/boards");
    } catch (error) {
      console.error("Error logging in:", error);
      throw error;
    }
  }

  async logout() {
    try {
      await axios.post(
        `${API_URL}/logout`,
        {},
        {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("access_token")}`,
          },
        }
      );

      localStorage.removeItem("access_token");
    } catch (error) {
      console.error("Error logging in:", error);
    }
  }
}

export default new AuthService();

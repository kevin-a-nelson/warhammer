import axios from "axios";
import router from "@/router"; // Import the router from your Vue instance

const API_URL = "http://localhost:8000/api"; // Replace with your API URL

class BoardService {
  async getBoards(userId) {
    try {
      const response = await axios.get(
        `${API_URL}/boards?user_id=${userId}`,
        {
          headers: {
            Accept: "application/json",
            Authorization: `Bearer ${localStorage.getItem("access_token")}`,
          },
        }
      );

      return response.data;
    } catch (error) {
      console.error("Error getting board:", error);
      throw error;
    }
  }
}

export default new BoardService();

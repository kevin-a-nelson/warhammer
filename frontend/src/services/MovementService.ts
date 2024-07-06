import axios, { type AxiosInstance } from 'axios';
import type { IApiService } from '../interfaces/IApiService';

class MovementService implements IApiService {
    private http: AxiosInstance;
  
    constructor() {
      this.http = axios.create({
        baseURL: 'https://api.example.com',
        headers: {
          'Content-Type': 'application/json',
        },
      });
    }
  
    get(endpoint: string, params = {}): Promise<any> {
      return this.http.get(endpoint, { params });
    }
  
    post(endpoint: string, data: object): Promise<any> {
      return this.http.post(endpoint, data);
    }
  
    put(endpoint: string, data: object): Promise<any> {
      return this.http.put(endpoint, data);
    }
  
    delete(endpoint: string): Promise<any> {
      return this.http.delete(endpoint);
    }
  }
  
export default new MovementService();

export interface IApiService {
  get(endpoint: string, params?: object): Promise<any>;
  post(endpoint: string, data: object): Promise<any>;
  put(endpoint: string, data: object): Promise<any>;
  delete(endpoint: string): Promise<any>;
}
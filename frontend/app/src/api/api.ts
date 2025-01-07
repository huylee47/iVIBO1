import axios, { Method } from "axios";

// Tạo một client Axios với baseURL và timeout
const apiClient = axios.create({
    baseURL: 'http://localhost:8000',  // Cập nhật nếu backend dùng địa chỉ hoặc cổng khác
    timeout: 1000000,  // Thời gian chờ là 10 giây. Thay đổi thời gian chờ lên 1000 giây để tiện debug
    headers: {
        'Content-Type': 'application/json',
    },
});

// Interceptor cho request, không tự động thêm Authorization
apiClient.interceptors.request.use(
    (config) => {
        return config;
    },
    (error) => {
        console.error('Interceptor Error:', error);
        return Promise.reject(error);
    }
);

apiClient.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.code === 'ECONNABORTED') {
            console.error('Timeout Error: Kết nối vượt quá thời gian cho phép.');
        } else if (error.message === 'Network Error') {
            console.error('Network Error: Không thể kết nối với server.');
        } else {
            // console.error('Error:', error);
        }
        return Promise.reject(error);
    }
);

// Hàm thực hiện request có gắn token khi cần
const requestWithAuth = (method: Method, url: string, data: any = {}) => {//Đề nghị loại bỏ method này
    const token = localStorage.getItem('token');
    const headers = token ? { Authorization: `Bearer ${token}` } : {};
    return apiClient({
        method,
        url,
        data,
        headers: { ...headers },
    });
};


const requestWithJWT = (method: Method, url: string, data: any = {}) => {//Method chuẩn để thêm token vào request
    let token = sessionStorage.getItem('token');
    if (token != null) {
        token = token.substring(1, token.length - 1);
    } else {
        return;
    }
    return apiClient({
        method,
        url,
        data,
        headers: {
            'Authorization': token,
            'Content-Type': 'application/json',
        },
    });
};
export { apiClient, requestWithAuth, requestWithJWT };

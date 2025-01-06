import { defineFakeRoute } from "vite-plugin-fake-server/client";

// 模拟刷新token接口
export default defineFakeRoute([
  {
    url: "/refresh-token",
    method: "post",
    response: ({ body }) => {
      if (body.refreshToken) {
        return {
          success: true,
          data: {
            accessToken: "eyJhbGciOiJIUzUxMiJ9.newAdmin",
            refreshToken: "eyJhbGciOiJIUzUxMiJ9.newAdminRefresh",
            // `expires`选择这种日期格式是为了方便调试，后端直接设置时间戳或许更方便（每次都应该递增）。如果后端返回的是时间戳格式，前端开发请来到这个目录`src/utils/auth.ts`，把第`38`行的代码换成expires = data.expires即可。
            // `expires` chọn định dạng ngày này để thuận tiện cho việc gỡ lỗi. Có thể thuận tiện hơn cho phần phụ trợ khi đặt dấu thời gian trực tiếp (nó nên được tăng lên mỗi lần). Nếu phần phụ trợ trả về định dạng dấu thời gian, các nhà phát triển giao diện người dùng nên truy cập thư mục này `src/utils/auth.ts` và thay thế mã trên dòng `38` bằng Expires = data.expires.
            expires: "2030/10/30 23:59:59"
          }
        };
      } else {
        return {
          success: false,
          data: {}
        };
      }
    }
  }
]);

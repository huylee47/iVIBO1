// 根据角色动态生成路由
import { defineFakeRoute } from "vite-plugin-fake-server/client";
import axios from "axios";
// export default defineFakeRoute([
//   {
//     url: "/login",
//     method: "post",
//     response: ({ body }) => {
//       if (body.username === "admin") {
//         return {
//           success: true,
//           data: {
//             avatar: "https://avatars.githubusercontent.com/u/44761321",
//             username: "admin",
//             nickname: "admin",
//             // 一个用户可能有多个角色
//             roles: ["admin"],
//             // 按钮级别权限
//             permissions: ["*:*:*"],
//             accessToken: "eyJhbGciOiJIUzUxMiJ9.admin",
//             refreshToken: "eyJhbGciOiJIUzUxMiJ9.adminRefresh",
//             expires: "2030/10/30 00:00:00"
//           }
//         };
//       } else {
//         return {
//           success: true,
//           data: {
//             avatar: "https://avatars.githubusercontent.com/u/52823142",
//             username: "common",
//             nickname: "小林",
//             roles: ["common"],
//             permissions: ["permission:btn:add", "permission:btn:edit"],
//             accessToken: "eyJhbGciOiJIUzUxMiJ9.common",
//             refreshToken: "eyJhbGciOiJIUzUxMiJ9.commonRefresh",
//             expires: "2030/10/30 00:00:00"
//           }
//         };
//       }
//     }
//   }
// ]);
export default defineFakeRoute([
  {
    url: "/login",
    method: "post",
    response: async ({ body }) => {
      try {
        const response = await axios.post(
          "http://127.0.0.1:8000/api/login",
          body
        );
        return response.data;
      } catch (error) {
        if (error.response) {
          console.error("Lỗi từ backend:", error.response.data.message);
          return {
            success: false,
            message: error.response.data.message || "Đăng nhập thất bại"
          };
        }
        console.error("Lỗi không mong muốn:", error.message);
        return {
          success: false,
          message: "Không thể kết nối tới server"
        };
      }
    }
  }
]);

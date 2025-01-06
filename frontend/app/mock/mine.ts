import { defineFakeRoute } from "vite-plugin-fake-server/client";
import { faker } from "@faker-js/faker/locale/zh_CN";

export default defineFakeRoute([
  // 账户设置-Thông tin cá nhân
  {
    url: "/mine",
    method: "get",
    response: () => {
      return {
        success: true,
        data: {
          avatar: "https://avatars.githubusercontent.com/u/44761321",
          username: "admin",
          nickname: "admin",
          email: " contact@ouransoft.vn",
          phone: "15888886789",
          description: "Chao xìn"
        }
      };
    }
  },
  // 账户设置-个人Nhật ký
  {
    url: "/mine-logs",
    method: "get",
    response: () => {
      let list = [
        {
          id: 1,
          ip: faker.internet.ipv4(),
          address: "Số 3 đường Lê Hồng Phong , Hải An , Hải Phòng",
          system: "macOS",
          browser: "Chrome",
          summary: "Đăng nhập tài khoản", // 详情 Chi tiết
          operatingTime: new Date() // 时间 thời gian
        },
        {
          id: 2,
          ip: faker.internet.ipv4(),
          address: "Số 3 đường Lê Hồng Phong , Hải An , Hải Phòng",
          system: "Windows",
          browser: "Firefox",
          summary: "Đăng nhập tài khoản",
          operatingTime: new Date().setDate(new Date().getDate() - 1)
        }
      ];
      return {
        success: true,
        data: {
          list,
          total: list.length, // 总条目数 Tổng số mục
          pageSize: 10, // 每页显示条目个数 Số mục được hiển thị trên mỗi trang
          currentPage: 1 // 当前页数 Số trang hiện tại
        }
      };
    }
  }
]);

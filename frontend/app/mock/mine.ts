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
          address: "中国河南省信阳市",
          system: "macOS",
          browser: "Chrome",
          summary: "账户登录", // 详情
          operatingTime: new Date() // 时间
        },
        {
          id: 2,
          ip: faker.internet.ipv4(),
          address: "中国广东省深圳市",
          system: "Windows",
          browser: "Firefox",
          summary: "绑定了手机号码",
          operatingTime: new Date().setDate(new Date().getDate() - 1)
        }
      ];
      return {
        success: true,
        data: {
          list,
          total: list.length, // 总条目数
          pageSize: 10, // 每页显示条目个数
          currentPage: 1 // 当前页数
        }
      };
    }
  }
]);

import { defineStore } from "pinia";
import {
  type userType,
  store,
  router,
  resetRouter,
  routerArrays,
  storageLocal
} from "../utils";
import {
  type UserResult,
  type RefreshTokenResult,
  getLogin,
  refreshTokenApi
} from "@/api/user";
import { useMultiTagsStoreHook } from "./multiTags";
import { type DataInfo, setToken, removeToken, userKey } from "@/utils/auth";

export const useUserStore = defineStore({
  id: "pure-user",
  state: (): userType => ({
    // 头像
    // Hình đại diện
    avatar: storageLocal().getItem<DataInfo<number>>(userKey)?.avatar ?? "",
    // 用户名
    // Tên người dùng
    username: storageLocal().getItem<DataInfo<number>>(userKey)?.username ?? "",
    // Tên
    nickname: storageLocal().getItem<DataInfo<number>>(userKey)?.nickname ?? "",
    // 页面级别权限
    // quền cấp trang
    roles: storageLocal().getItem<DataInfo<number>>(userKey)?.roles ?? [],
    // 按钮级别权限
    // Quyền cấp nút
    permissions:
      storageLocal().getItem<DataInfo<number>>(userKey)?.permissions ?? [],
    // 前端生成的验证码（按实际需求替换）
    // Mã xác minh do giao diện người dùng tạo ra (thay thế theo nhu cầu thực tế)
    verifyCode: "",
    // 判断登录页面显示哪个组件（0：登录（默认）、1：手机登录、2：二维码登录、3：注册、4：忘记密码）
    // Xác định thành phần nào hiển thị trên trang đăng nhập (0: Đăng nhập (mặc định), 1: Đăng nhập di động, 2: Đăng nhập bằng mã QR, 3: Đăng ký, 4: Quên mật khẩu)
    currentPage: 0,
    // 是否勾选了登录页的免登录
    // Tùy chọn không cần đăng nhập trên trang đăng nhập có được chọn không?
    isRemembered: false,
    // 登录页的免登录存储几天，默认7天
    // Trang đăng nhập sẽ được lưu trữ bao nhiêu ngày nếu không đăng nhập, mặc định là 7 ngày
    loginDay: 7
  }),
  actions: {
    /** 存储头像 */
    // Lưu hình đại diện
    SET_AVATAR(avatar: string) {
      this.avatar = avatar;
    },
    /** 存储用户名 */
    // Lưu trữ tên người dùng
    SET_USERNAME(username: string) {
      this.username = username;
    },
    /** 存储姓名 */
    // Lưu trữ tên
    SET_NICKNAME(nickname: string) {
      this.nickname = nickname;
    },
    /** 存储角色 */
    // Lưu trữ vai trò
    SET_ROLES(roles: Array<string>) {
      this.roles = roles;
    },
    /** 存储按钮级别权限 */
    // Lưu trữ quyền cấp nút
    SET_PERMS(permissions: Array<string>) {
      this.permissions = permissions;
    },
    /** 存储前端生成的验证码 */
    // Lưu trữ mã xác minh được tạo bởi giao diện người dùng
    SET_VERIFYCODE(verifyCode: string) {
      this.verifyCode = verifyCode;
    },
    /** 存储登录页面显示哪个组件 */
    // Lưu trữ thành phần nào được hiển thị trên trang đăng nhập
    SET_CURRENTPAGE(value: number) {
      this.currentPage = value;
    },
    /** 存储是否勾选了登录页的免登录 */
    // Lưu trữ xem tùy chọn đăng nhập miễn phí có được chọn trên trang đăng nhập hay không
    SET_ISREMEMBERED(bool: boolean) {
      this.isRemembered = bool;
    },
    /** 设置登录页的免登录存储几天 */
    // Đặt số ngày trang đăng nhập sẽ được lưu trữ mà không cần đăng nhập
    SET_LOGINDAY(value: number) {
      this.loginDay = Number(value);
    },
    /** 登入 */
    // Đăng nhập
    async loginByUsername(data) {
      return new Promise<UserResult>((resolve, reject) => {
        getLogin(data)
          .then(data => {
            if (data?.success) setToken(data.data);
            resolve(data);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    /** 前端登出（不调用接口） */
    // Đăng xuất front-end (không gọi giao diện)
    logOut() {
      this.username = "";
      this.roles = [];
      this.permissions = [];
      removeToken();
      useMultiTagsStoreHook().handleTags("equal", [...routerArrays]);
      resetRouter();
      router.push("/login");
    },
    /** 刷新`token` */
    // Làm mới `token`
    async handRefreshToken(data) {
      return new Promise<RefreshTokenResult>((resolve, reject) => {
        refreshTokenApi(data)
          .then(data => {
            if (data) {
              setToken(data.data);
              resolve(data);
            }
          })
          .catch(error => {
            reject(error);
          });
      });
    }
  }
});

export function useUserStoreHook() {
  return useUserStore(store);
}

import { checkin } from "@/router/enums";
export default {
  path: "/checkin",
  //   redirect "check-in"
  component: () => import("@/views/checkin/index.vue"),
  meta: {
    icon: "ri:alarm-line",
    title: "Chấm công",
    rank: checkin
  },
  children: [
    {
      path: "checkin/management",
      name: "checkinManagement",
      component: () => import("@/views/checkin/management.vue"),
      meta: {
        title: "Quản lý chấm công"
      }
    },
    {
      path: "/checkin/index",
      name: "CheckIn",
      component: () => import("@/views/checkin/index.vue"),
      meta: {
        title: "Chấm công"
      }
    },
    {
      path: "/checkin/history",
      name: "CheckInHistory",
      component: () => import("@/views/checkin/history.vue"),
      meta: {
        title: "Lịch sử chấm công"
      }
    }
  ]
} satisfies RouteConfigsTable;

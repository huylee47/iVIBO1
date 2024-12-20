import { task } from "@/router/enums";
export default {
  path: "/task",
  //   redirect: "/task/index",
  component: () => import("@/views/task/index.vue"),
  meta: {
    icon: "ri:task-line",
    title: "Công việc",
    rank: task
  },
  children: [
    {
      path: "task/add",
      name: "taskAdd",
      component: () => import("@/views/task/add.vue"),
      meta: {
        title: "Thêm công việc"
      }
    },
    {
      path: "/task/index",
      name: "task",
      component: () => import("@/views/task/index.vue"),
      meta: {
        title: "Công việc"
      }
    }
  ]
};

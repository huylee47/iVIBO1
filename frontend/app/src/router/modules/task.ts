import { task } from "@/router/enums";
export default {
  path: "/task",
  //   redirect: "/task/index",
  component: () => import("@/views/task/index.vue"),
  meta: {
    icon: "ri:task-line",
    title: "Công việc",
    rank: task
  }
};

import { project } from "@/router/enums";
export default {
  path: "/project",
  //   redirect: "/project/index",
  component: () => import("@/views/project/index.vue"),
  meta: {
    icon: "ri:projector-line",
    title: "Dự án",
    rank: project
  }
};

<template>
  <el-row :gutter="24" justify="space-around">
    <re-col
      v-motion
      class="mb-[18px]"
      :value="18"
      :xs="24"
      :initial="{ opacity: 0, y: 100 }"
      :enter="{ opacity: 1, y: 0, transition: { delay: 560 } }"
    >
      <el-card shadow="never" class="h-[580px]">
        <div class="flex justify-between">
          <span class="text-md font-medium">Danh sách dự án</span>
        </div>
        <WelcomeTable class="mt-3" @project="onProjectReceived"/>
      </el-card>
    </re-col>
    <re-col
      v-motion
      class="mb-[18px]"
      :value="6"
      :xs="24"
      :initial="{ opacity: 0, y: 100 }"
      :enter="{ opacity: 1, y: 0, transition: { delay: 640 } }"
    >
      <el-card shadow="never">
        <div class="flex justify-between">
          <span class="text-md font-medium">Thành viên dự án {{ project.project_name }}</span>
        </div>
        <el-scrollbar max-height="504" class="mt-3">
          <el-timeline>
            <el-timeline-item
              v-for="item in latestNewsData"
              :key="item.id"
              :timestamp="item.date"
            >
              <p class="text-text_color_regular text-sm">
                {{ ` ${item.name}, Vai trò: Quản lý dự án` }}
              </p>
            </el-timeline-item>
          </el-timeline>
        </el-scrollbar>
      </el-card>
    </re-col>
  </el-row>
</template>

<script setup lang="ts">
import ReCol from "@/components/ReCol";
import WelcomeTable from "./components/table/index.vue";
import {onMounted, ref} from "vue";

let latestNewsData = ref([]);
let project = ref({project_name: ""});

const onProjectReceived = (data) => {
  project.value = data;
  //get Project and then associated workers here
  latestNewsData.value = [];
  if (project.value.id == 1) {
    latestNewsData.value.push({
      id: 1,
      name: "God",
      date: "2025-01-07",
    });
  } else if(project.value.id == 2) {
    latestNewsData.value.push({
      id: 1,
      name: "Bùi Kim An",
      date: "2025-01-07",
    });
  }
};

onMounted(() => {
  // Properly push a new record to the array to trigger reactivity
  latestNewsData.value.push({
    id: 1,
    name: "God",
    date: "2025-01-07",
  });
});
</script>

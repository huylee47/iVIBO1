<script setup lang="ts">
import { ref } from "vue";
// https://zunnzunn.github.io/vue-ganttastic/introduction.html
import { GGanttChart, GGanttRow } from "@infectoone/vue-ganttastic";

const context = ref([
  [
    {
      week: "Thứ 2",
      beginDate: "06:00",
      endDate: "22:00",
      ganttBarConfig: {
        id: "0",
        hasHandles: true,
        label: "test 2",
        style: {
          background: "#e96560"
        }
      }
    }
  ],
  [
    {
      week: "Thứ 3",
      beginDate: "09:00",
      endDate: "18:00",
      ganttBarConfig: {
        id: "1",
        hasHandles: true,
        label: "test 3",
        style: {
          background: "#5ccfa3"
        }
      }
    }
  ],
  [
    {
      week: "Thứ 4",
      beginDate: "07:00",
      endDate: "20:00",
      ganttBarConfig: {
        id: "2",
        hasHandles: true,
        label: "test 4",
        style: {
          background: "#77d6fa"
        }
      }
    }
  ],
  [
    {
      week: "Thứ 5 ",
      beginDate: "06:00",
      endDate: "21:00",
      ganttBarConfig: {
        id: "3",
        hasHandles: true,
        label: "test 5",
        style: {
          color: "#fff",
          background: "#1b2a47"
        }
      }
    }
  ],
  [
    {
      week: "thứ 6 ",
      beginDate: "05:00",
      endDate: "19:00",
      ganttBarConfig: {
        id: "4",
        hasHandles: true,
        label: "test 6",
        style: {
          background: "#5ccfa3"
        }
      }
    }
  ],
  [
    {
      week: "Thứ 7 ",
      beginDate: "10:00",
      endDate: "22:00",
      ganttBarConfig: {
        id: "5",
        hasHandles: true,
        label: "test 7",
        style: {
          background: "#f8bc45"
        }
      }
    }
  ],
  [
    {
      week: "Chủ nhật",
      beginDate: "04:00",
      endDate: "23:59",
      ganttBarConfig: {
        id: "6",
        immobile: false,
        hasHandles: false,
        label: "test 8",
        style: {
          background: "#f3953d"
        }
      }
    }
  ]
]);

function getWeekRange() {
  const today = new Date();
  const dayOfWeek = today.getDay();

  const startDate = new Date(today);
  startDate.setDate(today.getDate() - dayOfWeek + 1);

  const endDate = new Date(startDate);
  endDate.setDate(startDate.getDate() + 6);

  const formatDate = date => {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const day = String(date.getDate()).padStart(2, "0");
    return `${year}-${month}-${day}`;
  };

  const currentWeekStart = formatDate(startDate);
  const currentWeekEnd = formatDate(endDate);

  return {
    currentWeekStart,
    currentWeekEnd
  };
}

const weekRangeInChina = getWeekRange();
</script>

<template>
  <g-gantt-chart
    chart-start="00:00"
    chart-end="23:59"
    precision="hour"
    date-format="HH:mm"
    bar-start="beginDate"
    bar-end="endDate"
    grid
  >
    <template #upper-timeunit>
      <h1>
        {{
          `${weekRangeInChina.currentWeekStart} / ${weekRangeInChina.currentWeekEnd}`
        }}
      </h1>
    </template>
    <g-gantt-row
      v-for="(item, index) in context"
      :key="index"
      :bars="item"
      :label="item[0].week"
      highlight-on-hover
    />
  </g-gantt-chart>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

const calendarRef = ref<HTMLElement | null>(null);

onMounted(() => {
  if (calendarRef.value) {
    const calendar = new Calendar(calendarRef.value, {
      plugins: [dayGridPlugin, interactionPlugin],
      initialView: "dayGridMonth",
      editable: true,
      selectable: true,
      events: [
        { title: "Event 1", start: "2024-12-20", end: "2024-12-22" },
        { title: "Event 2", start: "2024-12-25", end: "2024-12-26" }
      ]
    });

    calendar.render();
  }
});
</script>

<template>
  <div ref="calendarRef" />
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import axios from "axios";

const calendarRef = ref<HTMLElement | null>(null);
const events = ref<any[]>([]);

// Hàm để lấy dữ liệu từ API
const fetchTasks = async () => {
  const token = localStorage.getItem("token");

  if (!token) {
    alert("Bạn chưa đăng nhập!");
    return;
  }

  try {
    const response = await axios.get("http://127.0.0.1:8000/api/task/list", {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: "application/json"
      }
    });

    console.log("Dữ liệu trả về từ API:", response.data);

    // Chuyển đổi dữ liệu từ API thành dạng sự kiện phù hợp với FullCalendar
    events.value = response.data.map((task: any) => ({
      title: task.task,
      start: task.start_time, // Đảm bảo start_time có định dạng đúng
      end: task.end_time, // Đảm bảo end_time có định dạng đúng
      description: task.description,
      id: task.id // Giả sử task có id để cập nhật trên server
    }));

    // Cập nhật lại lịch sau khi lấy dữ liệu từ API
    if (calendarRef.value) {
      const calendar = new Calendar(calendarRef.value, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        editable: true, // Cho phép thay đổi kích thước và di chuyển sự kiện
        selectable: true,
        events: events.value, // Dữ liệu sự kiện
        eventClick: function (info) {
          alert(
            `Sự kiện: ${info.event.title}\nMô tả: ${info.event.extendedProps.description}`
          );
        },
        // Cho phép thay đổi thời gian sự kiện bằng cách kéo thả
        eventDrop: function (info) {
          const updatedEvent = info.event;
          console.log("Sự kiện đã di chuyển:", updatedEvent.title);
          console.log("Ngày bắt đầu mới:", updatedEvent.start);
          console.log("Ngày kết thúc mới:", updatedEvent.end);

          // Gửi yêu cầu API cập nhật thời gian sự kiện trên server
          axios
            .put(
              `http://127.0.0.1:8000/api/task/adjustTime/${updatedEvent.id}`,
              {
                start_time: updatedEvent.start.toISOString(),
                end_time: updatedEvent.end.toISOString()
              }
            )
            .then(response => {
              console.log("Cập nhật sự kiện thành công:", response.data);
            })
            .catch(error => {
              console.error(
                "Lỗi khi cập nhật sự kiện:",
                error.response || error
              );
              alert("Có lỗi xảy ra khi cập nhật sự kiện!");
            });
        },
        // Cho phép thay đổi thời gian sự kiện bằng cách thay đổi kích thước
        eventResize: function (info) {
          const updatedEvent = info.event;
          console.log("Sự kiện đã thay đổi kích thước:", updatedEvent.title);
          console.log("Ngày kết thúc mới:", updatedEvent.end);

          // Gửi yêu cầu API cập nhật thời gian sự kiện trên server
          axios
            .put(
              `http://127.0.0.1:8000/api/task/adjustTime/${updatedEvent.id}`,
              {
                start_time: updatedEvent.start.toISOString(),
                end_time: updatedEvent.end.toISOString()
              }
            )
            .then(response => {
              console.log("Cập nhật sự kiện thành công:", response.data);
            })
            .catch(error => {
              console.error(
                "Lỗi khi cập nhật sự kiện:",
                error.response || error
              );
              alert("Có lỗi xảy ra khi cập nhật sự kiện!");
            });
        }
      });

      calendar.render();
    }
  } catch (error) {
    console.error("Lỗi khi lấy nhiệm vụ:", error.response || error);
    alert("Có lỗi xảy ra khi lấy dữ liệu!");
  }
};

// Khi component được mount, gọi hàm fetchTasks để lấy dữ liệu và render lịch
onMounted(() => {
  fetchTasks();
});
</script>

<template>
  <div>
    <!-- Hiển thị lịch FullCalendar -->
    <div ref="calendarRef" />
  </div>
</template>

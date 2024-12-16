<script setup lang="ts">
import axios from "axios";
import { useGeolocation } from "@vueuse/core";

const { coords, error } = useGeolocation();

const handleCheckIn = async () => {
  const token = localStorage.getItem("token");
  console.log("Token khi check-in:", token);

  if (!token) {
    alert("Bạn chưa đăng nhập!");
    return;
  }

  if (!coords.value.latitude || !coords.value.longitude) {
    alert("Không thể lấy được vị trí!");
    return;
  }

  try {
    const response = await axios.post(
      "http://127.0.0.1:8000/api/check-in",
      {
        latitude: coords.value.latitude,
        longitude: coords.value.longitude
      },
      {
        headers: {
          Authorization: `Bearer ${token}`,
          Accept: "application/json"
        }
      }
    );
    alert(response.data.message);
  } catch (error) {
    console.error("Lỗi khi check-in:", error.response || error);
    alert(error.response?.data?.message || "Có lỗi xảy ra!");
  }
};
</script>
<template>
  <div>
    <h2>Chấm công</h2>
    <div v-if="!error">
      <p><strong>Vĩ độ:</strong> {{ coords.latitude }}</p>
      <p><strong>Kinh độ:</strong> {{ coords.longitude }}</p>
      <p><strong>Độ chính xác:</strong> {{ coords.accuracy }} m</p>
      <button @click="handleCheckIn">Check-in</button>
    </div>
    <div v-else>
      <p>Error: {{ error.message }}</p>
    </div>
  </div>
</template>

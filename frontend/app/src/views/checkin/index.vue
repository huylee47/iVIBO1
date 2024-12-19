<script setup lang="ts">
import { ref, onMounted, watch } from "vue";
import { useGeolocation } from "@vueuse/core";
import axios from "axios";

const { coords, error } = useGeolocation();
const mapContainer = ref<HTMLElement | null>(null);

const isValidCoordinates = (lat: number, lng: number): boolean => {
  return lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180;
};

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

const initializeMap = () => {
  if (coords.value.latitude && coords.value.longitude && mapContainer.value) {
    if (!isValidCoordinates(coords.value.latitude, coords.value.longitude)) {
      console.error("Vị trí không hợp lệ .");
      alert("Vị trí không hợp lệ. Không thể khởi tạo bản đồ.");
      return;
    }

    try {
      goongjs.accessToken = "tAF4YwqaL2jDx5Ykq6wtatkM0U8cOFb6UbsjO3pw";
      const map = new goongjs.Map({
        container: mapContainer.value,
        style: "https://tiles.goong.io/assets/goong_map_web.json",
        center: [coords.value.longitude, coords.value.latitude],
        zoom: 15
      });

      new goongjs.Marker()
        .setLngLat([coords.value.longitude, coords.value.latitude])
        .addTo(map);
    } catch (err) {
      console.error("Lỗi khi khởi tạo bản đồ:", err);
      alert("Không thể khởi tạo bản đồ.");
    }
  } else {
    console.error("Vị trí không hợp lệ hoặc không có div bản đồ.");
    alert("Không thể lấy vị trí hoặc không có div bản đồ.");
  }
};

watch(
  () => coords.value,
  newCoords => {
    if (newCoords.latitude !== Infinity && newCoords.longitude !== Infinity) {
      initializeMap();
    }
  },
  { immediate: true }
);
</script>

<template>
  <div>
    <h2>Chấm công</h2>
    <div id="map" ref="mapContainer" style="width: 100%; height: 400px" />
    <div v-if="!error">
      <p><strong>Độ chính xác:</strong> {{ coords.accuracy }} m</p>
      <button @click="handleCheckIn">Check-in</button>
    </div>
    <div v-else>
      <p>Error: {{ error.message }}</p>
    </div>
  </div>
</template>

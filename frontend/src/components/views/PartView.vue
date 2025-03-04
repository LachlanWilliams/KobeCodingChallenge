<script setup>
import api from "@/services/api.js";

import { ref, onMounted } from "vue";

import PartsFilter from "../PartsFilter.vue";
import PartsTable from "../PartsTable.vue";

const parts = ref([]);

onMounted(async () => {
  try {
    const response = await api.getParts();
    parts.value = response.data; // Store parts in the ref
  } catch (error) {
    console.error("Error fetching parts:", error);
  }
});
</script>

<template>
  <PartsFilter class="z-10" />
  <PartsTable :parts="parts" class="z-0" />
</template>

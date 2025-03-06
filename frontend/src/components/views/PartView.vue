<script setup>
import api from "@/services/api.js";
import { ref, onMounted } from "vue";
import PartsFilter from "../PartsFilter.vue";
import PartsTable from "../PartsTable.vue";

const parts = ref([]);
const makes = ref([]);
const selectedFilters = ref({ make: null, model: null, type: null });

onMounted(async () => {
  try {
    const response = await api.getParts();
    parts.value = response.data;
  } catch (error) {
    console.error("Error fetching parts:", error);
  }

  try {
    const response = await api.getMakes();
    makes.value = response.data;
  } catch (error) {
    console.error("Error fetching makes:", error);
  }
});

const updateFilters = (filters) => {
  selectedFilters.value = filters;
};
</script>

<template>
  <PartsFilter
    :makes="makes"
    @update-filters="updateFilters"
    :filters="selectedFilters"
    class="z-10"
  />
  <PartsTable
    :parts="parts"
    :filters="selectedFilters"
    @update-filter="updateFilters"
    class="z-0"
  />
</template>

<script>
import api from "@/services/api.js";

export default {
  data() {
    return {
      parts: [],
    };
  },
  async created() {
    try {
      const response = await api.getParts();
      this.parts = response.data; // Store parts in the data property
    } catch (error) {
      console.error("Error fetching parts:", error);
    }
  },
};
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Vehicle Parts</h1>
    <ul class="list-disc pl-5">
      <li v-for="part in parts" :key="part.id">
        <strong>{{ part.make }} - {{ part.model }}</strong
        >: {{ part.type }} ({{ part.part_number }})
      </li>
    </ul>
  </div>
</template>

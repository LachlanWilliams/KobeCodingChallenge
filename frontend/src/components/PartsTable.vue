<script setup>
import { defineProps } from "vue";

// Define props to receive parts
const props = defineProps({
  parts: Array,
});
</script>

<template>
  <div class="px-4 sm:px-6 lg:px-8 z-0">
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle">
          <table class="min-w-full border-separate border-spacing-0">
            <thead>
              <tr>
                <th
                  scope="col"
                  class="sticky top-0 z-0 border-b border-gray-300 bg-white/75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"
                >
                  Make
                </th>
                <th
                  scope="col"
                  class="sticky top-0 z-0 hidden border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell"
                >
                  Model
                </th>
                <th
                  scope="col"
                  class="sticky top-0 z-0 hidden border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell"
                >
                  Type
                </th>
                <th
                  scope="col"
                  class="sticky top-0 z-0 border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter"
                >
                  Part No
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(part, index) in props.parts" :key="part.id">
                <td
                  :class="[
                    index !== props.parts.length - 1
                      ? 'border-b border-gray-200'
                      : '',
                    'whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8',
                  ]"
                >
                  {{ part.make }}
                </td>
                <td
                  :class="[
                    index !== props.parts.length - 1
                      ? 'border-b border-gray-200'
                      : '',
                    'hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell',
                  ]"
                >
                  {{ part.model }}
                </td>
                <td
                  :class="[
                    index !== props.parts.length - 1
                      ? 'border-b border-gray-200'
                      : '',
                    'hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell',
                  ]"
                >
                  {{ part.Type }}
                </td>
                <td
                  :class="[
                    index !== props.parts.length - 1
                      ? 'border-b border-gray-200'
                      : '',
                    'whitespace-nowrap px-3 py-4 text-sm text-gray-500',
                  ]"
                >
                  {{ part.part_number }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

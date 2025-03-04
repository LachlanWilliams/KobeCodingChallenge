<script setup>
import { ref, defineProps, defineEmits, watch } from "vue";
import { ChevronDownIcon, CheckIcon } from "@heroicons/vue/20/solid";
import {
  Listbox,
  ListboxButton,
  ListboxLabel,
  ListboxOption,
  ListboxOptions,
} from "@headlessui/vue";
import api from "../services/api.js"; // Import API

const props = defineProps({
  makes: Array, // Pass makes from the parent component
});

// Emit function
const emit = defineEmits(["update-filters"]);

// Reactive state
const models = ref([]);
const types = ref([]);
const selectedMake = ref(null);
const selectedModel = ref(null);
const selectedType = ref(null);

// Watch for make selection and fetch models
watch(selectedMake, async (newMake) => {
  if (newMake) {
    try {
      const response = await api.getModels(newMake);
      models.value = response.data;
      selectedModel.value = null; // Reset model selection
      types.value = [];
      selectedType.value = null;
    } catch (error) {
      console.error("Error fetching models:", error);
      models.value = [];
    }
  } else {
    models.value = [];
    selectedModel.value = null;
    types.value = [];
    selectedType.value = null;
  }
  emit("update-filters", {
    make: selectedMake.value,
    model: selectedModel.value,
    type: selectedType.value,
  });
});

// Watch for model selection and fetch types
watch(selectedModel, async (newModel) => {
  if (selectedMake.value && newModel) {
    try {
      const response = await api.getTypes(selectedMake.value, newModel);
      types.value = response.data;
      selectedType.value = null;
    } catch (error) {
      console.error("Error fetching types:", error);
      types.value = [];
    }
  } else {
    types.value = [];
    selectedType.value = null;
  }
  emit("update-filters", {
    make: selectedMake.value,
    model: selectedModel.value,
    type: selectedType.value,
  });
});

// Watch for type selection
watch(selectedType, (newType) => {
  emit("update-filters", {
    make: selectedMake.value,
    model: selectedModel.value,
    type: newType,
  });
});
</script>

<template>
  <div class="bg-white z-40">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">
        Vehicle Parts
      </h1>
      <p class="mt-4 max-w-xl text-sm text-gray-700">
        Use the filters to view different parts.
      </p>
    </div>

    <!-- Filters -->
    <section aria-labelledby="filter-heading">
      <h2 id="filter-heading" class="sr-only">Filters</h2>
      <div class="border-b border-gray-200 bg-white pb-4">
        <div
          class="mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8"
        >
          <!-- Makes list -->
          <Listbox as="div" v-model="selectedMake">
            <ListboxLabel class="block text-sm font-medium text-gray-900"
              >Makes</ListboxLabel
            >
            <div class="relative mt-2">
              <ListboxButton
                class="grid w-48 cursor-default grid-cols-1 rounded-md bg-white py-1.5 pl-3 pr-2 text-left text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm"
              >
                <span class="col-start-1 row-start-1 truncate pr-6">
                  {{ selectedMake ? selectedMake : "Select a make" }}
                </span>
                <ChevronDownIcon
                  class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                  aria-hidden="true"
                />
              </ListboxButton>

              <transition
                leave-active-class="transition ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
              >
                <ListboxOptions
                  class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                >
                  <ListboxOption
                    as="template"
                    v-for="make in makes"
                    :key="make.id"
                    :value="make"
                  >
                    <li
                      class="relative cursor-default select-none py-2 pl-3 pr-9"
                      :class="[
                        selectedMake === make
                          ? 'bg-indigo-600 text-white'
                          : 'text-gray-900',
                      ]"
                    >
                      <span class="block truncate">{{ make }}</span>
                      <span
                        v-if="selectedMake === make"
                        class="absolute inset-y-0 right-0 flex items-center pr-4"
                      >
                        <CheckIcon class="size-5" aria-hidden="true" />
                      </span>
                    </li>
                  </ListboxOption>
                </ListboxOptions>
              </transition>
            </div>
          </Listbox>

          <!-- Models list -->
          <Listbox as="div" v-model="selectedModel" :disabled="!selectedMake">
            <ListboxLabel class="block text-sm font-medium text-gray-900"
              >Models</ListboxLabel
            >
            <div class="relative mt-2">
              <ListboxButton
                class="grid w-48 cursor-default grid-cols-1 rounded-md py-1.5 pl-3 pr-2 text-left outline outline-1 sm:text-sm"
                :class="
                  selectedMake
                    ? 'bg-white text-gray-900 outline-gray-300'
                    : 'bg-gray-100 text-gray-500 cursor-not-allowed outline-gray-200'
                "
              >
                <span class="col-start-1 row-start-1 truncate pr-6">
                  {{ selectedModel ? selectedModel : "Select a model" }}
                </span>
                <ChevronDownIcon
                  class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                  aria-hidden="true"
                />
              </ListboxButton>

              <transition
                leave-active-class="transition ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
              >
                <ListboxOptions
                  class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                >
                  <ListboxOption
                    as="template"
                    v-for="model in models"
                    :key="model.id"
                    :value="model"
                  >
                    <li
                      class="relative cursor-default select-none py-2 pl-3 pr-9"
                      :class="[
                        selectedModel === model
                          ? 'bg-indigo-600 text-white'
                          : 'text-gray-900',
                      ]"
                    >
                      <span class="block truncate">{{ model }}</span>
                      <span
                        v-if="selectedModel === model"
                        class="absolute inset-y-0 right-0 flex items-center pr-4"
                      >
                        <CheckIcon class="size-5" aria-hidden="true" />
                      </span>
                    </li>
                  </ListboxOption>
                </ListboxOptions>
              </transition>
            </div>
          </Listbox>

          <!-- Types list -->
          <Listbox as="div" v-model="selectedType" :disabled="!selectedModel">
            <ListboxLabel class="block text-sm font-medium text-gray-900"
              >Types</ListboxLabel
            >
            <div class="relative mt-2">
              <ListboxButton
                class="grid w-48 cursor-default grid-cols-1 rounded-md py-1.5 pl-3 pr-2 text-left outline outline-1 sm:text-sm"
                :class="
                  selectedModel
                    ? 'bg-white text-gray-900 outline-gray-300'
                    : 'bg-gray-100 text-gray-500 cursor-not-allowed outline-gray-200'
                "
              >
                <span class="col-start-1 row-start-1 truncate pr-6">
                  {{ selectedType ? selectedType : "Select a type" }}
                </span>
                <ChevronDownIcon
                  class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                  aria-hidden="true"
                />
              </ListboxButton>

              <transition
                leave-active-class="transition ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
              >
                <ListboxOptions
                  class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                >
                  <ListboxOption
                    as="template"
                    v-for="type in types"
                    :key="type.id"
                    :value="type"
                  >
                    <li
                      class="relative cursor-default select-none py-2 pl-3 pr-9"
                      :class="[
                        selectedType === type
                          ? 'bg-indigo-600 text-white'
                          : 'text-gray-900',
                      ]"
                    >
                      <span class="block truncate">{{ type }}</span>
                      <span
                        v-if="selectedType === type"
                        class="absolute inset-y-0 right-0 flex items-center pr-4"
                      >
                        <CheckIcon class="size-5" aria-hidden="true" />
                      </span>
                    </li>
                  </ListboxOption>
                </ListboxOptions>
              </transition>
            </div>
          </Listbox>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
const modelValue = defineModel<string>()
</script>

<template>
  <div class="mb-4">
    <input
      v-model="modelValue"
      type="text"
      placeholder="Buscar usuario..."
      class="border rounded p-2 w-full"
    />
  </div>
</template>

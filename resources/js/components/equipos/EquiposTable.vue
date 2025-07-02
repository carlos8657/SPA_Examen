<script setup lang="ts">
import type { PropType } from 'vue'

interface Equipo {
  id: number
  nombre_equipo: string
  tipo_motor: string
  fecha_fabricacion: string
  potencia_kw: number
  velocidad_rpm: number
}

const props = defineProps<{
  equipos: Equipo[]
}>()


const emit = defineEmits<{
  (e: 'edit', equipo: Equipo): void
  (e: 'delete', equipo: Equipo): void
}>()

</script>

<template>
  <table class="w-full border border-gray-300">
    <thead>
      <tr class="bg-gray-200">
        <th class="p-2 border">ID</th>
        <th class="p-2 border">Nombre Equipo</th>
        <th class="p-2 border">Tipo Motor</th>
        <th class="p-2 border">Fecha Fabricación</th>
        <th class="p-2 border">Potencia (kW)</th>
        <th class="p-2 border">Velocidad (rpm)</th>
        <th class="p-2 border">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="equipo in equipos" :key="equipo.id" class="hover:bg-gray-100">
        <td class="p-2 border">{{ equipo.id }}</td>
        <td class="p-2 border">{{ equipo.nombre_equipo }}</td>
        <td class="p-2 border">{{ equipo.tipo_motor }}</td>
        <td class="p-2 border">{{ equipo.fecha_fabricacion }}</td>
        <td class="p-2 border">{{ equipo.potencia_kw }}</td>
        <td class="p-2 border">{{ equipo.velocidad_rpm }}</td>
        <td class="p-2 border space-x-2">
          <button @click="emit('edit', equipo)" class="text-blue-600">Editar</button>
          <button @click="emit('delete', equipo)" class="text-red-600">Eliminar</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

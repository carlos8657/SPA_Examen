<script setup lang="ts">
interface Usuario {
  id: number
  name: string
  email: string
  active: boolean
}

const props = defineProps<{
  usuarios: Usuario[]
}>()

const emit = defineEmits<{
  (e: 'edit', user: Usuario): void
  (e: 'delete', user: Usuario): void
}>()
</script>

<template>
  <table class="w-full border border-gray-300">
    <thead>
      <tr class="bg-gray-200">
        <th class="p-2 border">ID</th>
        <th class="p-2 border">Nombre</th>
        <th class="p-2 border">Email</th>
        <th class="p-2 border">Activo</th>
        <th class="p-2 border">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="usuario in props.usuarios" :key="usuario.id" class="hover:bg-gray-100">
        <td class="p-2 border">{{ usuario.id }}</td>
        <td class="p-2 border">{{ usuario.name }}</td>
        <td class="p-2 border">{{ usuario.email }}</td>
        <td class="p-2 border">{{ usuario.active ? 'Activo' : 'Inactivo' }}</td>
        <td class="p-2 border space-x-2">
          <button @click="$emit('edit', usuario)" class="text-blue-600">Editar</button>
          <button @click="$emit('delete', usuario)" class="text-red-600">Eliminar</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

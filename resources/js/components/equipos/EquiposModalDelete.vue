<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'

interface Equipo {
  id: number
  nombre_equipo: string
}

const props = defineProps<{ 
  open: boolean; 
  equipo: Equipo | null 
}>()
const emit = defineEmits(['update:open'])


function eliminar() {
  if (!props.equipo) return
  useForm({}).delete(route('equipos.destroy', props.equipo.id), {
    onSuccess: () => {
      emit('update:open', false)
    },
  })
}
</script>

<template>
  <Dialog :open="props.open" @close="emit('update:open', false)" class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
      <DialogPanel class="bg-white p-6 rounded shadow w-full max-w-sm">
        <DialogTitle class="text-lg font-bold mb-4">Eliminar Equipo</DialogTitle>
        <p class="mb-4">¿Estás seguro que deseas eliminar el equipo <strong>{{ props.equipo?.nombre_equipo }}</strong>?</p>
        <div class="flex justify-end space-x-2">
          <button @click="emit('update:open', false)" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
          <button @click="eliminar" class="px-4 py-2 bg-red-500 text-white rounded">Eliminar</button>
        </div>
      </DialogPanel>
    </div>
  </Dialog>
</template>

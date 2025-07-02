<script setup lang="ts">
import { Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps<{ open: boolean }>()
const emit = defineEmits(['update:open'])

const addForm = useForm({
  nombre_equipo: '',
  tipo_motor: '',
  fecha_fabricacion: '',
  potencia_kw: '',
  velocidad_rpm: '',
})

function submit() {
  addForm.post(route('equipos.store'), {
    onSuccess: () => {
      emit('update:open', false)
      addForm.reset()
    },
  })
}



</script>

<template>
  <Dialog :open="props.open" @close="emit('update:open', false)" class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
      <DialogPanel class="bg-white p-6 rounded shadow w-full max-w-md">
        <DialogTitle class="text-lg font-bold mb-4">Agregar Equipo</DialogTitle>
        <form @submit.prevent="submit">
          <input v-model="addForm.nombre_equipo" type="text" placeholder="Nombre Equipo" class="w-full border p-2 mb-2" />
          <input v-model="addForm.tipo_motor" type="text" placeholder="Tipo Motor" class="w-full border p-2 mb-2" />
          <input v-model="addForm.fecha_fabricacion" type="date" class="w-full border p-2 mb-2" />
          <input v-model="addForm.potencia_kw" type="number" step="0.01" placeholder="Potencia (kW)" class="w-full border p-2 mb-2" />
          <input v-model="addForm.velocidad_rpm" type="number" placeholder="Velocidad (rpm)" class="w-full border p-2 mb-2" />
          <div class="flex justify-end space-x-2">
            <button type="button" @click="emit('update:open', false)" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Guardar</button>
          </div>
        </form>
      </DialogPanel>
    </div>
  </Dialog>
</template>

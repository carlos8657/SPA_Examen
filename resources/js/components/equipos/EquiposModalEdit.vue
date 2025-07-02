<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'
import { watch } from 'vue'

interface Equipo {
  id: number
  nombre_equipo: string
  tipo_motor: string
  fecha_fabricacion: string
  potencia_kw: number
  velocidad_rpm: number
}

const props = defineProps<{ 
  open: boolean; 
  equipo: Equipo | null 
}>()

const emit = defineEmits(['update:open'])

const editForm = useForm({
  nombre_equipo: '',
  tipo_motor: '',
  fecha_fabricacion: '',
  potencia_kw: '',
  velocidad_rpm: '',
})

watch(
  () => props.equipo, 
  (nuevo) => {
  if (nuevo) {
    editForm.nombre_equipo = nuevo.nombre_equipo
    editForm.tipo_motor = nuevo.tipo_motor
    editForm.fecha_fabricacion = nuevo.fecha_fabricacion
    editForm.potencia_kw = nuevo.potencia_kw.toString()
    editForm.velocidad_rpm = nuevo.velocidad_rpm.toString()
  }
})


function submit() {
  if (!props.equipo) return
  editForm.put(route('equipos.update', props.equipo.id), {
    onSuccess: () => {
      emit('update:open', false)
      editForm.reset()
    },
  })
}
</script>

<template>
  <Dialog :open="props.open" @close="emit('update:open', false)" class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
      <DialogPanel class="bg-white p-6 rounded shadow w-full max-w-md">
        <DialogTitle class="text-lg font-bold mb-4">Editar Equipo</DialogTitle>
        <form @submit.prevent="submit">
          <input v-model="editForm.nombre_equipo" type="text" placeholder="Nombre Equipo" class="w-full border p-2 mb-2" />
          <input v-model="editForm.tipo_motor" type="text" placeholder="Tipo Motor" class="w-full border p-2 mb-2" />
          <input v-model="editForm.fecha_fabricacion" type="date" class="w-full border p-2 mb-2" />
          <input v-model="editForm.potencia_kw" type="number" step="0.01" placeholder="Potencia (kW)" class="w-full border p-2 mb-2" />
          <input v-model="editForm.velocidad_rpm" type="number" placeholder="Velocidad (rpm)" class="w-full border p-2 mb-2" />
          <div class="flex justify-end space-x-2">
            <button type="button" @click="emit('update:open', false)" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Actualizar</button>
          </div>
        </form>
      </DialogPanel>
    </div>
  </Dialog>
</template>

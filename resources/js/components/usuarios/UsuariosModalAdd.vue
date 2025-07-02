<script setup lang="ts">
import { Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps<{ open: boolean }>()
const emit = defineEmits(['update:open'])

const addForm = useForm({
  name: '',
  email: '',
  password: '',
})

function submit() {
  addForm.post(route('usuarios.store'), {
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
      <DialogPanel class="bg-white p-6 rounded w-full max-w-md">
        <DialogTitle class="text-lg font-bold mb-4">Agregar Usuario</DialogTitle>
        <form @submit.prevent="submit">
          <input v-model="addForm.name" placeholder="Nombre" class="w-full border p-2 mb-2" />
          <input v-model="addForm.email" type="email" placeholder="Correo" class="w-full border p-2 mb-2" />
          <input v-model="addForm.password" type="password" placeholder="Contraseña" class="w-full border p-2 mb-2" />
          <div class="flex justify-end space-x-2">
            <button type="button" @click="emit('update:open', false)" class="bg-gray-300 px-4 py-2 rounded">Cancelar</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
          </div>
        </form>
      </DialogPanel>
    </div>
  </Dialog>
</template>

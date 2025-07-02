<script setup lang="ts">
import { Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'
import { useForm } from '@inertiajs/vue3'
import { watch } from 'vue'

interface Usuario {
  id: number
  name: string
  email: string
  active: boolean
}

const props = defineProps<{
  open: boolean
  usuario: Usuario | null
}>()

const emit = defineEmits(['update:open'])

const editForm = useForm({
  name: '',
  email: '',
  active: true as boolean,
})

watch(
  () => props.usuario,
  (nuevo) => {
    if (nuevo) {
      editForm.name = nuevo.name
      editForm.email = nuevo.email
      editForm.active = nuevo.active
    }
  }
)

function submit() {
  if (!props.usuario) return
  editForm.put(route('usuarios.update', props.usuario.id), {
    onSuccess: () => {
      emit('update:open', false)
    },
  })
}
</script>

<template>
  <Dialog :open="open" @close="emit('update:open', false)" class="fixed inset-0 z-10 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
      <DialogPanel class="bg-white p-6 rounded w-full max-w-md">
        <DialogTitle class="text-lg font-bold mb-4">Editar Usuario</DialogTitle>
        <form @submit.prevent="submit">
          <input v-model="editForm.name" placeholder="Nombre" class="w-full border p-2 mb-2" />
          <input v-model="editForm.email" type="email" placeholder="Correo" class="w-full border p-2 mb-2" />
          <label class="block mb-2">Activo:
            <select v-model="editForm.active" class="w-full border p-2">
              <option :value="true">Activo</option>
              <option :value="false">Inactivo</option>
            </select>
          </label>
          <div class="flex justify-end space-x-2">
            <button type="button" @click="emit('update:open', false)" class="bg-gray-300 px-4 py-2 rounded">Cancelar</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
          </div>
        </form>
      </DialogPanel>
    </div>
  </Dialog>
</template>

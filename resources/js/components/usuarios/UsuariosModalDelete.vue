<script setup lang="ts">
import { Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'
import { useForm } from '@inertiajs/vue3'

interface Usuario {
  id: number
  name: string
}

const props = defineProps<{
  open: boolean
  usuario: Usuario | null
}>()

const emit = defineEmits(['update:open'])

function eliminar() {
  if (!props.usuario) return

  useForm({}).delete(route('usuarios.destroy', props.usuario.id), {
    onSuccess: () => {
      emit('update:open', false)
    },
  })
}
</script>

<template>
  <Dialog :open="open" @close="emit('update:open', false)" class="fixed inset-0 z-10 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
      <DialogPanel class="bg-white p-6 rounded w-full max-w-sm">
        <DialogTitle class="text-lg font-bold mb-4">Eliminar Usuario</DialogTitle>
        <p class="mb-4">¿Estás seguro de eliminar a <strong>{{ usuario?.name }}</strong>?</p>
        <div class="flex justify-end space-x-2">
          <button @click="emit('update:open', false)" class="bg-gray-300 px-4 py-2 rounded">Cancelar</button>
          <button @click="eliminar" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
        </div>
      </DialogPanel>
    </div>
  </Dialog>
</template>

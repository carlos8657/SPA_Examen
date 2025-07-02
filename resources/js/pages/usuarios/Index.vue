<script setup lang="ts">
import { ref, computed } from 'vue'
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

import Buscador from '@/components/usuarios/Buscador.vue'
import UsuariosTable from '@/components/usuarios/UsuariosTable.vue'
import UsuarioModalAdd from '@/components/usuarios/UsuariosModalAdd.vue'
import UsuarioModalEdit from '@/components/usuarios/UsuariosModalEdit.vue'
import UsuarioModalDelete from '@/components/usuarios/UsuariosModalDelete.vue'

interface Usuario {
  id: number
  name: string
  email: string
  active: boolean
}

const props = defineProps<{
  usuarios: Usuario[]
}>()

const appName = import.meta.env.VITE_APP_NAME || 'No tengo nombre :('

const search = ref('')
const selectedUser = ref<Usuario | null>(null)
const showAddModal = ref(false)
const showEditModal = ref(false)
const showDeleteModal = ref(false)

const filteredUsuarios = computed(() =>
  !search.value
    ? props.usuarios
    : props.usuarios.filter((u) =>
        u.name.toLowerCase().includes(search.value.toLowerCase()) ||
        u.email.toLowerCase().includes(search.value.toLowerCase())
      )
)

function openEdit(user: Usuario) {
  selectedUser.value = user
  showEditModal.value = true
}

function openDelete(user: Usuario) {
  selectedUser.value = user
  showDeleteModal.value = true
}
</script>

<template>
  <AppLayout>
    <Head>
      <title>{{ appName }} - Usuarios</title>
    </Head>

    <div class="p-6">
      <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Usuarios</h1>
        <button @click="showAddModal = true" class="bg-blue-500 text-white px-4 py-2 rounded">
          + Agregar
        </button>
      </div>

      <Buscador v-model="search" />

      <UsuariosTable
        :usuarios="filteredUsuarios"
        @edit="openEdit"
        @delete="openDelete"
      />
    </div>

    <UsuarioModalAdd v-model:open="showAddModal" />
    <UsuarioModalEdit v-model:open="showEditModal" :usuario="selectedUser" />
    <UsuarioModalDelete v-model:open="showDeleteModal" :usuario="selectedUser" />
  </AppLayout>
</template>

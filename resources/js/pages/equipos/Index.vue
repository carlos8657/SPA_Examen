<script setup lang="ts">
import { ref, computed } from 'vue'
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

import Buscador from '@/components/equipos/Buscador.vue'
import EquiposTable from '@/components/equipos/EquiposTable.vue'
import EquipoModalAdd from '@/components/equipos/EquiposModalAdd.vue'
import EquipoModalEdit from '@/components/equipos/EquiposModalEdit.vue'
import EquipoModalDelete from '@/components/equipos/EquiposModalDelete.vue'

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

const appName = import.meta.env.VITE_APP_NAME || 'No tengo nombre :('

const search = ref('')
const selectedEquipo = ref<Equipo | null>(null)
const showAddModal = ref(false)
const showEditModal = ref(false)
const showDeleteModal = ref(false)

const filteredEquipos = computed(() =>
  !search.value
    ? props.equipos
    : props.equipos.filter((e) =>
        e.nombre_equipo.toLowerCase().includes(search.value.toLowerCase()) ||
        e.tipo_motor.toLowerCase().includes(search.value.toLowerCase())
      )
)

function openEdit(equipo: Equipo) {
  selectedEquipo.value = equipo
  showEditModal.value = true
}

function openDelete(equipo: Equipo) {
  selectedEquipo.value = equipo
  showDeleteModal.value = true
}
</script>

<template>
  <AppLayout>
    <Head>
      <title>{{ appName }} - Equipos</title>
    </Head>

    <div class="p-6">
      <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Equipos</h1>
        <button @click="showAddModal = true" class="bg-blue-500 text-white px-4 py-2 rounded">
          + Agregar
        </button>
      </div>

      <Buscador v-model="search" />

      <EquiposTable
        :equipos="filteredEquipos"
        @edit="openEdit"
        @delete="openDelete"
      />
    </div>

    <EquipoModalAdd v-model:open="showAddModal" />
    <EquipoModalEdit v-model:open="showEditModal" :equipo="selectedEquipo" />
    <EquipoModalDelete v-model:open="showDeleteModal" :equipo="selectedEquipo" />
  </AppLayout>
</template>

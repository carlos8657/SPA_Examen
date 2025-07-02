<template>
  <div class="flex min-h-screen bg-gray-100">
    <aside class="w-64 bg-white shadow p-4">
      <h2 class="text-xl font-bold mb-6">Menú</h2>
      <nav>
        <Link href="/usuarios" class="block mb-2 text-blue-500 hover:underline">Usuarios</Link>
        <Link href="/equipos" class="block mb-2 text-blue-500 hover:underline">Equipos</Link>
        <Link href="/logout" method="post" as="button" class="text-red-500 hover:underline">Cerrar sesión</Link>
      </nav>
    </aside>

    <main class="flex-1 p-6">
      <slot />
    </main>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
</script>

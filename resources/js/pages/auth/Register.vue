<template>
  <Head>
    <title>{{ appName }} - Registro</title>
  </Head>

  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <form @submit.prevent="submit" class="w-full max-w-sm bg-white p-6 rounded shadow">
      <h2 class="text-xl font-bold mb-4">Registro</h2>

      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Nombre</label>
        <input v-model="form.name" type="text" class="w-full border rounded p-2" />
        <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Correo</label>
        <input v-model="form.email" type="email" class="w-full border rounded p-2" />
        <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Contraseña</label>
        <input v-model="form.password" type="password" class="w-full border rounded p-2" />
        <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Confirmar contraseña</label>
        <input v-model="form.password_confirmation" type="password" class="w-full border rounded p-2" />
      </div>

      <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Registrarse</button>

      <Link :href="route('login')" class="block text-center text-sm mt-4 text-blue-600">Volver al login</Link>
    </form>
  </div>
</template>

<script setup lang="ts">
import { useForm, Head, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const appName = import.meta.env.VITE_APP_NAME || 'Mi App'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

function submit() {
  form.post(route('register.post'))
}
</script>

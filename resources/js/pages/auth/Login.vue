<template>
  <Head>
     <title>{{ appName }} - Iniciar sesión</title>
  </Head>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <form @submit.prevent="submit" class="w-full max-w-sm bg-white p-6 rounded shadow">
      <h2 class="text-xl font-bold mb-4">Iniciar sesión</h2>

      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Correo</label>
        <input v-model="form.email" type="email" class="w-full border rounded p-2" required />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Contraseña</label>
        <input v-model="form.password" type="password" class="w-full border rounded p-2" required />
      </div>

      <div v-if="form.errors.email" class="text-red-500 text-sm mb-4">
        {{ form.errors.email }}
      </div>

      <div v-if="form.errors.password" class="text-red-500 text-sm mb-4">
        {{ form.errors.password }}
      </div>

      <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">
        Iniciar sesión
      </button>
      <div class="mt-4 text-center">
        <span class="text-gray-600">¿No tienes una cuenta? </span>
        <Link href="/register" class="text-blue-500 hover:underline">Regístrate</Link>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { useForm, Head, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const appName = import.meta.env.VITE_APP_NAME || 'Sin nombre'

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

function submit() {
  form.post(route('login.post'))
}
</script>

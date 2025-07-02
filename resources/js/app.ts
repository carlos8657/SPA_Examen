import { createApp, h, DefineComponent } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
  resolve: async (name) => {
    const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue')
    const page = pages[`./pages/${name}.vue`]

    if (!page) {
      throw new Error(`Página ${name} no encontrada`)
    }

    return await page()
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})

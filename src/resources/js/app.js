import Vue from 'vue'
import vuetify from './vuetify'
import { createInertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'

Vue.config.productionTip = false

InertiaProgress.init()

createInertiaApp({
  resolve: name => require(`./Pages/${name}.vue`),
  setup({ el, app, props }) {
    new Vue({
        vuetify,
      render: h => h(app, props),
    }).$mount(el)
  },
})

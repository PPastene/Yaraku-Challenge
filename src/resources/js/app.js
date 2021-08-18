import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { createInertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

InertiaProgress.init()

createInertiaApp({
  resolve: name => require(`./Pages/${name}.vue`),
  setup({ el, app, props }) {
    new Vue({
      render: h => h(app, props),
    }).$mount(el)
  },
})

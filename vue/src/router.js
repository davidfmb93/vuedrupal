import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import About from './views/About.vue'


Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [{
      path: '/',
      name: 'home',
      component: Home,
      meta: {
        title: "Disfruta un mundo de beneficios"
      },
    },
    {
        path: '/vue/:path',
        name: 'about',
        component: About,
        meta: {
          title: "Disfruta un mundo de beneficios"
        },
    },
  ]
})

export default router

import { createRouter, createWebHistory } from 'vue-router'
import BoardView from '../views/BoardView.vue'
import BoardsView from '../views/BoardsView.vue'
import LoginView from '../views/LoginView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/boards",
      name: "boards",
      component: BoardsView
    },
    {
      path: "/boards/:boardId",
      name: "board",
      component: BoardView
    },
    {
      path: "/login",
      name: "login",
      component: LoginView
    },
  ]
})

export default router

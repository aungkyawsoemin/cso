import { createWebHistory, createRouter } from "vue-router";
import Home from "../views/Home.vue";
import About from "../views/About.vue";
import QuizIndex from "../views/quiz/Index.vue";
import QuizDetail from "../views/quiz/Detail.vue";
import QuizResult from "../views/quiz/Result.vue";
import NotFound from "../views/NotFound.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/about",
    name: "About",
    component: About,
  },
  {
    path: "/quiz",
    name: "QuizIndex",
    component: QuizIndex,
  },
  {
    path: "/quiz/:id/detail",
    name: "QuizDetail",
    component: QuizDetail,
  },
  {
    path: "/quiz/:id/result",
    name: "QuizResult",
    component: QuizResult,
  },
  {
    path: "/:catchAll(.*)",
    component: NotFound,
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
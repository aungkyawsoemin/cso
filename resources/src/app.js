import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import {store} from './store'
import Constants from './constants'

const app = createApp(App);
app.provide('CONSTANTS', {
    'QUESTION_TYPE_SINGLE': 0,
    'QUESTION_TYPE_MULTIPLE': 1,
    'QUESTION_TYPE_DROPDOWN': 2,
})
app.use(router);
app.use(store).mount('#app');
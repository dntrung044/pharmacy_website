import { createApp } from 'vue';
import App from './App.vue'
import router from './router/index.js'

const app = createApp({});

createApp(App).use(router).mount("#app")

import './bootstrap';
import '../css/app.css';
import './assets/css/now-ui-kit.css';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router/index.js';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import { createPinia } from 'pinia';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';

const pinia = createPinia();
const app = createApp(App);

app.use(router);
app.use(ElementPlus);
app.use(pinia);
app.use(Toast);
app.use(PrimeVue, {
    theme: {
        preset: Aura
    }
});

app.mount('#app');

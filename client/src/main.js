import { createApp, defineAsyncComponent } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';
import sprite from '@/images/icons/sprite.js'

const app = createApp(App);
const pinia = createPinia();

const components = import.meta.glob('./components/UI/**/*.vue');

for (const path in components) {
  const componentName = path
    .split('/')
    .pop()
    .replace('.vue', '');
  app.component(componentName, defineAsyncComponent(components[path]));
}

const injectSprite = () => {
  const div = document.createElement('div');
  div.innerHTML = sprite;
  div.classList.add('visually-hidden');
  document.body.appendChild(div);
};

injectSprite();

app.use(router);
app.use(pinia);
app.use(sprite);
app.mount('#app');

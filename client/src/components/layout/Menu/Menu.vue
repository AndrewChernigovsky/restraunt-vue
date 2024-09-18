<template>
  <div class="menu-wrapper">
    <div>
      <button
        type="button"
        @click="toggleMenu"
        class="active"
        id="burger-button"
      >
        <span class="visually-hidden">Закрыть меню</span>
      </button>
      <nav class="nav" ref="navRef">
        <router-link
          v-for="link in links"
          :key="link.path"
          class="nav__link"
          active-class="active"
          :to="link.path"
          @click="toggleMenu"
        >
          {{ link.name }}
        </router-link>
      </nav>
    </div>
  </div>
</template>
<script setup>
import { onMounted } from 'vue';
import { useDataStore } from '@/store';

const dataLinks = useDataStore();

onMounted(async () => {
  dataLinks.fetchData('/server/api.php');

  console.log(dataLinks.getData());
});
</script>
<style lang="scss" scoped></style>

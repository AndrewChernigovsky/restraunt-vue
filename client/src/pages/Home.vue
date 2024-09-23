<template lang="">
  <div>
    <h2>Редактировать ссылки меню</h2>
    <div class="buttons-edit">
      <Button type="button" @click="handleButtonClick('create')">
        Create Table
      </Button>
      <Button type="button" @click="handleButtonClick('delete')">
        Delete Table
      </Button>
    </div>

    <form @submit.prevent="submitForm">
      <label for="">Link: <input type="text" v-model="newLink.name" /></label>
      <label for=""
        >Link Path: <input type="text" v-model="newLink.path"
      /></label>
      <Button type="button" @click="addedLink(newLink.name, newLink.path)"
        >add</Button
      >
      <p>Все ссылки:</p>
      <Links :links="links" :deleteLink="deleteLink" />
    </form>
  </div>
</template>
<script setup>
import { ref, watchEffect } from 'vue';
import { useDataLinks } from '@/store/useDataLinks.js';
import { storeToRefs } from 'pinia';
import Links from '@/components/Links/Links.vue';

const store = useDataLinks();
const { getData } = storeToRefs(store);

let prod = false;
const path = prod ? 'https://andrey-andreevich.ru' : 'http://restraunt-vue';
const links = ref([]);
const newLink = ref({ name: '', path: '' });
const newDataLinks = ref([]);

async function addedLink(name, pathLink) {
  try {
    const newLinkEntry = { name: name, path: pathLink };

    await fetch(
      `${path}/server/test.php?action=addLink&name=${name}&path=${pathLink}`,
      {
        method: 'GET',
      }
    );
    store.addLink(newLinkEntry);
  } catch (error) {
    console.error('Ошибка при получении данных:', error);
  }
}

async function deleteLink(id) {
  try {
    await fetch(`${path}/server/test.php?action=deleteLink&id=${id}`, {
      method: 'GET',
    });
    store.removeLink(id);
  } catch (error) {
    console.error('Ошибка при получении данных:', error);
  }
}

async function handleButtonClick(action) {
  try {
    await fetch(`${path}/server/test.php?action=${action}`, {
      method: 'GET',
    });
  } catch (error) {
    console.error('Ошибка при получении данных:', error);
  }
}

watchEffect(() => {
  links.value = getData;
});
</script>
<style lang="scss" scoped>
.buttons-edit {
  position: absolute;
  right: 20px;
  top: 20px;
}
</style>

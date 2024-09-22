<template lang="">
  <div>
    <h2>Редактировать ссылки меню</h2>
    <button type="button" @click="handleButtonClick('create')">
      Create Table
    </button>
    <button type="button" @click="handleButtonClick('delete')">
      Delete Table
    </button>

    <form @submit.prevent="submitForm">
      <label for="">Link: <input type="text" v-model="newLink.name" /></label>
      <label for=""
        >Link Path: <input type="text" v-model="newLink.path"
      /></label>
      <button type="button" @click="addLink(12, newLink.name, newLink.path)">
        add
      </button>
      <p>Все ссылки:</p>
      <ul>
        <li v-for="link in links.value" :key="link.id">
          {{ link.name + ' ' + link.path + link.id }}
          <button type="button" @click="deleteLink(link.id)">Delete</button>
        </li>
      </ul>
    </form>
  </div>
</template>
<script setup>
import { ref, watchEffect } from 'vue';
import { useDataLinks } from '@/store/useDataLinks.js';
import { storeToRefs } from 'pinia';

const store = useDataLinks();
const { getData } = storeToRefs(store);

const links = ref([]);
const newLink = ref({ id: '', name: '', path: '' });
const newDataLinks = ref([]);

async function addLink(id, name, path) {
  newDataLinks.value.push({ ...newLink.value });
  console.log(links.value.value, 'VALUEEEEEEE');
  links.value.push({ ...newLink.value });
  try {
    await fetch(
      `http://restraunt-vue/server/test.php?action=addLink&id=${id}&name=${name}&path=${path}`,
      {
        method: 'GET',
      }
    );
  } catch (error) {
    console.error('Ошибка при получении данных:', error);
  }
}
async function deleteLink(id) {
  try {
    await fetch(
      `http://restraunt-vue/server/test.php?action=deleteLink&id=${id}`,
      {
        method: 'GET',
      }
    );
  } catch (error) {
    console.error('Ошибка при получении данных:', error);
  }
}
async function handleButtonClick(action) {
  try {
    await fetch(`http://restraunt-vue/server/test.php?action=${action}`, {
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
<style lang=""></style>

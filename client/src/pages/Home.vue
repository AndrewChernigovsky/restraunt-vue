<template lang="">
  <div>
    <h2>Редактировать ссылки меню</h2>
    <div class="buttons-edit">
      <button type="button" @click="handleButtonClick('create')">
        Create Table
      </button>
      <button type="button" @click="handleButtonClick('delete')">
        Delete Table
      </button>
    </div>

    <form @submit.prevent="submitForm">
      <label for="">Link: <input type="text" v-model="newLink.name" /></label>
      <label for=""
        >Link Path: <input type="text" v-model="newLink.path"
      /></label>
      <button type="button" @click="addedLink(newLink.name, newLink.path)">
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
import { v4 as uuidv4 } from 'uuid'; // Importing the v4 function from uuid

const uuid = ref('');

function generateUUID() {
  uuid.value = uuidv4(); // Generate a new UUID
}

const store = useDataLinks();
const { getData } = storeToRefs(store);

const links = ref([]);
const newLink = ref({ name: '', path: '' });

async function addedLink(name, path) {
  generateUUID();
  let id = uuid.value;
  console.log(id, 'ID');
  const newLinkEntry = { id: id, name: name, path: path };
  console.log(newLinkEntry, 'links');
  store.addLink(newLinkEntry);
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
    store.removeLink(id);
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

<style lang="scss" scoped>
.buttons-edit {
  position: absolute;
  right: 20px;
  top: 20px;
}
</style>

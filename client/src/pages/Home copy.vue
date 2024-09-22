<template lang="">
  <div>
    <h2>Редактировать сслыки меню</h2>
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
      <button type="button" @click="addLink(newLink.name, newLink.path)">
        add
      </button>
      <p>Все ссылки:</p>
      <ul>
        <li v-for="link in links" :key="link.name">
          {{ link.name + ' ' + link.path + link.id }}
          <button type="button" @click="deleteLink(link.id)">Delete</button>
        </li>
      </ul>
    </form>
  </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';

const links = ref([]);
const newLink = ref({ name: '', path: '' });
const newDataLinks = ref([]);

async function fetchLinks() {
  try {
    const response = await fetch(
      'http://restraunt-vue/server/test.php?action=links'
    );
    if (!response.ok) {
      throw new Error('Ошибка сети');
    }
    const data = await response.json();
    console.log(data, 'data');
    links.value = data;
  } catch (error) {
    console.error('Ошибка при получении данных:', error);
  }
}

async function addLink(name, path) {
  newDataLinks.value.push({ ...newLink.value });
  links.value.push({ ...newLink.value });
  try {
    await fetch(
      `http://restraunt-vue/server/test.php?action=addLink&name=${name}&path=${path}`,
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

// async function submitForm() {
//   if (newLink.value.name && newLink.value.path) {
//     // Формируем данные для отправки
//     const dataToSend = JSON.stringify(newDataLinks.value);
//     console.log(dataToSend, 'dataSend');

//     try {
//       const response = await fetch('http://restraunt-vue/server/test.php', {
//         method: 'POST',
//         headers: {
//           'Content-Type': 'application/json',
//         },
//         body: dataToSend,
//       });

//       if (!response.ok) {
//         throw new Error('Network response was not ok');
//       }

//       const result = await response.json();
//       console.log(result); // Выводим результат в консоль
//     } catch (error) {
//       console.error('Ошибка при отправке данных:', error);
//     }

//     // Сбросим форму после отправки
//     newLink.value = { name: '', path: '' };
//   } else {
//     alert('Пожалуйста, заполните все поля.');
//   }
// }

async function handleButtonClick(action) {
  try {
    await fetch(`http://restraunt-vue/server/test.php?action=${action}`, {
      method: 'GET',
    });
  } catch (error) {
    console.error('Ошибка при получении данных:', error);
  }
}

onMounted(fetchLinks);
</script>
<style lang=""></style>

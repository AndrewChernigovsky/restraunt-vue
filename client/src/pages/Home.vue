<template lang="">
  <div>
    <h2>Редактировать сслыки меню</h2>
    <!-- <button type="button" @click="createMenu">Create Menu</button>
    <button type="button" @click="deleteTable">Delete Table</button> -->

    <form @submit.prevent="submitForm">
      <label for="">Link: <input type="text" v-model="newLink.name" /></label>
      <label for=""
        >Link Path: <input type="text" v-model="newLink.path"
      /></label>
      <button type="button" @click="addLink">add</button>
      <p>Все добавленные ссылки:</p>
      <ul>
        <li v-for="link in dataBaseLinks" :key="link.name">
          {{ link.name + ' ' + link.path }}
          <button type="button" @click="deleteLink(link)">Delete</button>
        </li>
      </ul>
      <p>Все новые ссылки:</p>
      <ul>
        <li v-for="link in links" :key="link.name">
          {{ link.name + ' ' + link.path }}
          <button type="button" @click="deleteLink(link)">Delete</button>
        </li>
      </ul>
      <button>Опубликовать</button>
    </form>
  </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';

const links = ref([]);
const newLink = ref({ name: '', path: '' });
const dataBaseLinks = ref([]);

async function fetchLinks() {
  try {
    const response = await fetch(
      'http://restraunt-vue/server/db/get-menu-links.php'
    ); // Убедитесь, что URL правильный
    if (!response.ok) {
      throw new Error('Ошибка сети');
    }
    const data = await response.json();
    console.log(data, 'data');
    dataBaseLinks.value = data; // Предполагаем, что ответ - это массив объектов ссылок
  } catch (error) {
    console.error('Ошибка при получении данных:', error);
  }
}

function addLink() {
  links.value.push({ ...newLink.value });
}

async function submitForm() {
  // Добавляем новую ссылку в массив
  if (newLink.value.name && newLink.value.path) {
    links.value = dataBaseLinks.value.filter(
      (link1) =>
        !links.value.some(
          (link2) => link1.name === link2.name && link1.path === link2.path
        )
    );
    links.value.push({ ...newLink.value });

    // Формируем данные для отправки
    const dataToSend = JSON.stringify(links.value);

    try {
      const response = await fetch('http://restraunt-vue/server/test.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: dataToSend,
      });

      if (!response.ok) {
        throw new Error('Network response was not ok');
      }

      const result = await response.json();
      console.log(result); // Выводим результат в консоль
    } catch (error) {
      console.error('Ошибка при отправке данных:', error);
    }

    // Сбросим форму после отправки
    newLink.value = { name: '', path: '' };
  } else {
    alert('Пожалуйста, заполните все поля.');
  }
}
onMounted(fetchLinks);
</script>
<style lang=""></style>

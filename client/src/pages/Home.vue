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
      <button @click="addLink">add</button>
      <p>Все добавленные ссылки:</p>
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
import { ref } from 'vue';

const links = ref([]);
const newLink = ref({ name: '', path: '' });

async function createMenu() {
  try {
    const response = await fetch(
      'http://restraunt-vue/server/db/create-menu-links.php'
    );
  } catch (error) {
    console.error('Ошибка:', error);
  }
}

async function submitForm() {
  // Добавляем новую ссылку в массив
  if (newLink.value.name && newLink.value.path) {
    links.value.push({ ...newLink.value });

    // Формируем данные для отправки
    const dataToSend = JSON.stringify(links.value);

    try {
      const response = await fetch(
        'http://restraunt-vue/server/db/create-menu-links.php',
        {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: dataToSend,
        }
      );

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
</script>
<style lang=""></style>

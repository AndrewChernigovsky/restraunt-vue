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
      <div class="create-link">
        <label for=""
          >Наименование ссылки: <input type="text" v-model="newLink.name"
        /></label>
        <label for=""
          >Куда ведет ссылка: <input type="text" v-model="newLink.path"
        /></label>
        <Button
          class="button"
          type="button"
          @click="addedLink(newLink.name, newLink.path)"
          icon="plus"
        />
      </div>
      <p>Все ссылки:</p>
      <Links :links="links" :deleteLink="deleteLink" />
    </form>
  </div>
</template>
<script setup>
import { ref, watchEffect } from 'vue';
import Links from '@/components/Links/Links.vue';
import { storeToRefs } from 'pinia';
import { useDataLinks } from '@/store/useDataLinks.js';

const store = useDataLinks();
const { getData } = storeToRefs(store);

let prod = false;
const path = prod ? 'https://andrey-andreevich.ru' : 'http://restraunt-vue';
const links = ref([]);
const newLink = ref({ name: '', path: '' });

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
.create-link {
  display: flex;
  align-items: center;
  gap: 5px;

  .button {
    margin-left: 5px;
    cursor: pointer;

    &:hover {
      opacity: 0.3;
    }
  }
}

.buttons-edit {
  position: absolute;
  right: 20px;
  top: 20px;
}

.button {
  color: $WHITE;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: $TRANSAPRENT;
  border: 1px solid $BLACK;
  background-color: $BLACK;
  border-radius: 50%;

  svg {
    width: 60px;
    height: 40px;
  }
}
</style>

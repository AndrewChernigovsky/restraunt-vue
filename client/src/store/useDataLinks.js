import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useDataLinks = defineStore('dataStoreLinks', () => {
  const data = ref([])
  const res = ref([])
  const getData = computed(() => data.value)
  async function fetchLinks() {
    try {
      const response = await fetch(
        'http://restraunt-vue/server/test.php?action=links'
      );
      if (!response.ok) {
        throw new Error('Ошибка сети');
      }
      res.value = await response.json();
      if (res.value) {
        data.value = res.value;
      }
    } catch (error) {
      console.error('Ошибка при получении данных:', error);
    }
  }

  function addLink(link) {
    return data.value.push(link)
  }

  function removeLink(id) {
    const filteredLinks = data.value.filter(link => link.id !== id);
    data.value = filteredLinks;
  }

  (async () => {
    await fetchLinks()
  })();

  return {
    data, getData, addLink, removeLink
  }
});
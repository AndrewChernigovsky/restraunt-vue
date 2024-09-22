import { defineStore } from 'pinia';

export const useDataStore = defineStore('dataStore', () => {
  const data = ref([])
  const getData = computed(() => data)
  async function fetchData(url) {
    try {
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const data = await response.json();
      this._data = data;
    } catch (error) {
      console.error('Ошибка при получении данных:', error);
    }
  }

  return {
    data, getData, fetchData
  }
});
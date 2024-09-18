import { defineStore } from 'pinia';

export const useDataStore = defineStore('dataStore', {
  state: () => ({
    _data: [],
  }),
  getters: {
    getData: (state) => state._data,
  },
  actions: {
    async fetchData(url) {
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
    },
  },
});
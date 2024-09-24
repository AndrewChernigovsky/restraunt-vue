<template lang="">
  <ul class="links">
    <li class="link" v-for="link in links.value" :key="link.id">
      <a :href="link.path">{{ link.name }}</a>
      <Button class="button" type="button" @click="deleteLink(link.id)"
        ><svg><use href="#minus" /></svg
      ></Button>
    </li>
  </ul>
</template>
<script setup>
import { useDataLinks } from '@/store/useDataLinks.js';
import { storeToRefs } from 'pinia';
import { ref, watchEffect } from 'vue';

const props = defineProps({
  links: {
    type: Array,
    required: true,
  },
  deleteLink: {
    type: Function,
    required: true,
  },
});

const store = useDataLinks();
const { getData } = storeToRefs(store);

const links = ref([]);

watchEffect(() => {
  links.value = getData;
});
</script>
<style lang="scss" scoped>
.links {
  display: grid;
  gap: 5px;
  align-items: center;
}

.link {
  gap: 10px;
  align-items: center;
  display: flex;
  min-height: 40px;
  cursor: pointer;

  &:hover button {
    display: flex;

    &:hover {
      cursor: pointer;
      opacity: 0.3;
    }
  }
}

.button {
  color: $WHITE;
  width: 30px;
  height: 30px;
  display: none;
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

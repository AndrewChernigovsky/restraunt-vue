<template lang="">
  <ul class="links">
    <li v-for="link in links.value" :key="link.id">
      <a :href="link.path">{{ link.name }}</a>
      <Button type="button" @click="deleteLink(link.id)"
        ><svg><use href="#minus" /></svg
      ></Button>
    </li>
  </ul>
</template>
<script setup>
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
</script>
<style lang="scss" scoped>
.links {
  display: flex;
}
</style>

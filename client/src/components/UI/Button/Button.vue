<template>
  <button>
    <svg v-if="icon && pos === 'left'">
      <use :href="`#${icon}`"></use>
    </svg>
    <slot />
    <svg v-if="icon && pos === 'right'">
      <use :href="`#${icon}`"></use>
    </svg>
  </button>
</template>
<script setup>
const props = defineProps({
  icon: {
    type: String,
    required: false,
  },
  pos: {
    type: String,
    required: false,
    default: 'right',
  },
});
</script>
<style lang="scss" scoped>
button {
  &:focus {
    border: 2px solid red;
  }
  svg {
    height: inherit;
  }
}
</style>

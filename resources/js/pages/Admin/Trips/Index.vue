<script setup lang="ts">
type IndexProps = {
  trips: any[]
};
defineProps<IndexProps>();
</script>

<template>
  <p>Index trips</p>
  <pre>{{ $page.props.trips }}</pre>
</template>

<style lang="scss">
</style>

<script setup lang="ts">
const props = defineProps({
    data: Array
});
</script>

<template>
    <div v-for="(row, index) in data" :key="index">
        {{ row }}
    </div>
</template>

<style scoped>

</style>

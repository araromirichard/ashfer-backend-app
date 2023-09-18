<template>
    <div class="rounded-lg shadow-sm p-4">
        <div class="text-5xl font-semibold mb-2">{{ value }}</div>
        <div class="text-lg">{{ title }}</div>
    </div>
</template>
  
<script setup>

const { title, value } = defineProps({
    title: String,
    value: Number,
});


</script>
  
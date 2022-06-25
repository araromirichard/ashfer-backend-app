<template>
    <div class="flex items-center justify-between">
        <jet-Button
            :href="prevUrl"
            :disabled="!prevUrl"
            :class="{
                'opacity-50': !prevUrl,
            }"
        >
            previous
        </jet-Button>
        <jet-Button
            :href="nextUrl"
            :disabled="!nextUrl"
            :class="{
                'opacity-50': !nextUrl,
            }"
        >
            next
        </jet-Button>
    </div>
</template>

<script setup>
import jetButton from "@/Jetstream/Button.vue";

const props = defineProps({
    prevUrl: {},
    nextUrl: {},
});
</script>

<style lang="scss" scoped></style>

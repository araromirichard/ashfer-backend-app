<template>
    <table>
        <thead>
            <tr>
                <th
                    :class="header.class || 'text-left'"
                    v-for="(header, index) in headers"
                    :key="`header-${index}`"
                >
                    {{ header.name }}
                </th>
            </tr>
        </thead>
        <tbody>
            <slot></slot>
        </tbody>
    </table>
</template>

<script setup>
const props = defineProps({
    headers: {
        type: Array,
        required: true,
    },
});
</script>

<style lang="scss" scoped></style>

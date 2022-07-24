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
            <tr v-if="items.data.length === 0" class="">
                <td class="p-4" :colspan="headers.length">No data Available</td>
            </tr>
        </tbody>
    </table>
    <div class="mt-4" v-if="items.data.length > 0">
        <SimplePagination
            :prev-url="items.links.prev"
            :next-url="items.links.next"
        />
    </div>
</template>


<script setup>
import SimplePagination from "@/Components/SimplePagination.vue";
const props = defineProps({
    headers: {
        type: Array,
        required: true,
    },
    items: {
        type: Object,
        required: true,
    },
});
</script>

<style lang="scss" scoped></style>

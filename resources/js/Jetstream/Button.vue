<script setup>
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    type: {
        type: String,
        default: "submit",
    },
    href: {
        type: String,
        default: null,
    },
});

function visit(e) {
    e.preventDefault();
    if (!props.href) {
        return;
    }

    Inertia.visit(props.href);
}
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
        @click="visit"
    >
        <slot />
    </button>
</template>

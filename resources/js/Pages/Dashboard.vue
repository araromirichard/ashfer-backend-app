<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import { computed } from "vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import ValueCards from "../Components/ValueCards.vue";

defineProps({
    articleCount: Number,
    categoryCount: Number,
    tagCount: Number,
})

let breadcrumbs = computed(() => {
    return [
        {
            label: "Dashboard",
        },

    ];
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-10 py-6 w-auto h-screen md:h-80 min-h-[60%]">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <ValueCards class="bg-red-50 border border-red-100"  title="Tags" :value="tagCount" />
                        <ValueCards class="bg-teal-50 border border-teal-100"  title="Categories" :value="categoryCount" />
                        <ValueCards class="bg-indigo-50 border border-indigo-100"  title="Articles" :value="articleCount" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

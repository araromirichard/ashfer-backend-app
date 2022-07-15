<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import { computed } from "vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";

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
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    This is the Dashboard content area
                </div>
            </div>
        </div>
    </AppLayout>
</template>

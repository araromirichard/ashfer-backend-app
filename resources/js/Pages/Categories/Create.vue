<template>
    <AppLayout title="Dashboard">
        <template #header>
            <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
        </template>

        <Container>
            <Card>
                <form @submit.prevent="saveCategory">
                    <div>
                        <jet-label for="name" value="Name" />
                        <jet-input
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            autocomplete="name"
                        />
                        <jet-input-error
                            :message="form.error.name"
                            class="mt-2"
                        />
                    </div>

                    <!-- slug -->

                    <div class="mt-4">
                        <jet-label for="slug" value="Slug" />
                        <jet-input
                            id="slug"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.slug"
                            autocomplete="slug"
                        />
                        <jet-input-error
                            :message="form.error.slug"
                            class="mt-2"
                        />
                    </div>

                    <div class="mt-4">
                        <jet-action-message
                            :on="form.recentlySuccessful"
                            class="mr-3"
                        >
                            <span v-if="edit">Updated.</span>
                            <span v-else>Saved.</span>
                        </jet-action-message>

                        <jet-button
                            v-on:click="saveCategory"
                            type="submit"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            <span v-if="edit">Update</span>
                            <span v-else>Save</span>
                        </jet-button>
                    </div>
                </form>
            </Card>
        </Container>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetActionMessage from "@/Jetstream/ActionMessage";
import { useForm } from "@inertiajs/inertia-vue3";
import { watch, computed } from "vue";
import { strSlug } from "@/helpers.js";
import Container from "../../Components/Container.vue";
import Card from "../../Components/Card.vue";
import Breadcrumbs from "../../Components/Breadcrumbs.vue";

const form = useForm({
    name: "",
    slug: "",
    error: {
        name: null,
        slug: null,
    },
    recentlySuccessful: false,
    processing: false,
});

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});



let breadcrumbs = computed(() => {
    return [
        {
            label: "Categories",
            url: route("categories.index"),
        },
        {
            label: "Add Category",
        },
    ];
});

const saveCategory = () => {
    form.post(route("categories.store"));
};

watch(
    () => form.name,
    (newValue) => {
        form.slug = strSlug(newValue);
    },
    { immediate: true }
);
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
        </template>

        <Container>
            <Card>
                <form @submit.prevent="saveTag">
                    <div>
                        <jet-label for="name" value="Name" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                            autocomplete="name" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <!-- slug -->

                    <div class="mt-4">
                        <jet-label for="slug" value="Slug" />
                        <jet-input id="slug" type="text" class="mt-1 block w-full" v-model="form.slug"
                            autocomplete="slug" />
                        <jet-input-error :message="form.errors.slug" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <jet-label for="description" value="Description (Optional)" />
                        <TextArea id="description" class="mt-1 block w-full" v-model="form.description"
                            autocomplete="description" />
                    </div>

                    <div class="mt-4">
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                            <span v-if="edit">Updated.</span>
                            <span v-else>Saved.</span>
                        </jet-action-message>

                        <jet-button v-on:click="saveTag" type="submit" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
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
import { watch, computed, onMounted } from "vue";
import { strSlug } from "@/helpers.js";
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import TextArea from "@/Components/TextArea.vue";

const form = useForm({
    name: "",
    slug: "",
    description: "",
    error: {
        name: null,
        slug: null,
    },
    recentlySuccessful: false,
    processing: false,
});

const props = defineProps({
    edit: Boolean,
    tag: Object,
    errors: Object,
});



const saveTag = () => {
    props.edit
        ? form.put(route("tags.update", { id: props.tag.data.id }))
        : form.post(route("tags.store"));
    //form.post(route("tags.store"));
};

watch(
    () => form.name, // watch the form.name field
    (newValue) => {
        form.slug = strSlug(newValue);
    },
    { immediate: true }
);

onMounted(() => {
    if (props.edit) {
        form.name = props.tag.data.name;
        form.slug = props.tag.data.slug;
        form.description = props.tag.data.description || "";
    }
});
</script>

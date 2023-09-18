<template>
    <app-layout>
        <template #header>
            <Breadcrumbs :items="breadcrumbs" />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form class="p-4 sm:p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg" @submit.prevent="saveArticle">
                    <AppImage class="mt-2" v-model="form.image" :image-url="imageUrl" label="Image"
                        :error-message="form.errors.image" />

                    <div class="mt-4">
                        <jet-label for="category" value="Category" />

                        <select name="category" id="category"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            v-model="form.category_id">
                            <option value="">Select</option>
                            <option v-for="category in categories.data" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        <jet-input-error :message="form.errors.category_id" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <jet-label for="tag" value="Tag" />

                        <select name="tag" id="tag"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            v-model="form.tag_id" multiple>
                            <!-- <option value="">Select</option> -->
                            <option v-for="tag in tags.data" :key="tag.id" :value="tag.id">
                                {{ tag.name }}
                            </option>
                        </select>
                        <jet-input-error :message="form.errors.tag_id" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <jet-label for="title" value="Title" />
                        <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title"
                            autocomplete="title" />
                        <jet-input-error :message="form.errors.title" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label for="slug" value="Slug" />
                        <jet-input id="slug" type="text" class="mt-1 block w-full" v-model="form.slug"
                            autocomplete="slug" />
                        <jet-input-error :message="form.errors.slug" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label for="description" value="Description" />

                        <AppCkeditor class="mt-1" v-model="form.description" />

                        <jet-input-error :message="form.errors.description" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-button v-on:click="saveArticle" type="submit" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Save
                        </jet-button>
                    </div>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout";
import Breadcrumbs from "@/Components/Breadcrumbs";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import AppImage from "@/Components/Image";
import AppCkeditor from "@/Components/Ckeditor";
import { useForm } from "@inertiajs/inertia-vue3";
import { computed, onMounted, ref } from 'vue';
import { strSlug } from '@/helpers.js';

const props = defineProps({
    edit: Boolean,
    article: Object,
    categories: {
        type: Object,
        default: () => ({ data: [] }),
    },
    tags: {
        type: Object,
        default: () => ({ data: [] }),
    },
    errors: Object,
});

const form = useForm({
    category_id: '',
    tag_id: [],
    title: '',
    slug: '',
    description: props.edit ? props.article.data.description : '',
    image: null,
});

const breadcrumbs = computed(() => [
    { label: 'Articles', url: route('articles.index') },
    { label: 'Add Article' },
]);

const imageUrl = ref('');

const saveArticle = () => {
    console.log(JSON.stringify(form, null, 2));
    props.edit
        ? form.put(route('articles.update', { id: props.article.data.id }))
        : form.post(route('articles.store'));
};

onMounted(() => {
    if (props.edit) {
        form.category_id = props.article.data.category_id;
        // Convert comma-separated tag IDs into an array
        // form.tag_id = props.article.data.tag_id.split(',').map(tagId => parseInt(tagId, 10));
        form.title = props.article.data.title;
        form.slug = props.article.data.slug;
    }
    imageUrl.value = props.article.data.image_url;
    console.log(imageUrl.value);
});

</script>

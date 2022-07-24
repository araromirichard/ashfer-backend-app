<template>
    <app-layout>
        <template #header>
            <Breadcrumbs :items="breadcrumbs" />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form
                    class="p-4 sm:p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveArticle"
                >
                    <AppImage
                        class="mt-2"
                        v-model="form.image"
                        :image-url="imageUrl"
                        label="Image"
                        :error-message="form.errors.image"
                    />

                    <!-- <div>
                        <input
                            type="file"
                            class="hidden"
                            ref="photo"
                            @change="updatePhotoPreview"
                        /> -->

                    <!-- <jet-label for="Photo" value="Image" /> -->

                    <!-- Current Profile Photo -->
                    <!-- <div class="mt-2" v-show="!photoPreview">
                            <img
                                :src="imageUrl"
                                class="rounded-full h-20 w-20 object-cover"
                            />
                        </div> -->

                    <!-- New Profile Photo Preview -->
                    <!-- <div class="mt-2" v-show="photoPreview">
                            <span
                                class="block rounded-full w-20 h-20"
                                :style="
                                    'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                    photoPreview +
                                    '\');'
                                "
                            >
                            </span>
                        </div>

                        <jet-secondary-button
                            class="mt-2 mr-2"
                            type="button"
                            @click.native.prevent="selectNewPhoto"
                        >
                            Select A New Photo
                        </jet-secondary-button>

                        <jet-input-error
                            :message="form.errors.image"
                            class="mt-2"
                        />
                    </div> -->

                    <div class="mt-4">
                        <jet-label for="category" value="Category" />

                        <select
                            name="category"
                            id="category"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            v-model="form.category_id"
                        >
                            <option value="">Select</option>
                            <option
                                v-for="category in categories.data"
                                :key="category.id"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                        <jet-input-error
                            :message="form.errors.category_id"
                            class="mt-2"
                        />
                    </div>

                    <div class="mt-4">
                        <jet-label for="title" value="Title" />
                        <jet-input
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            autocomplete="title"
                        />
                        <jet-input-error
                            :message="form.errors.title"
                            class="mt-2"
                        />
                    </div>

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
                            :message="form.errors.slug"
                            class="mt-2"
                        />
                    </div>

                    <div class="mt-4">
                        <jet-label for="description" value="Description" />

                        <AppCkeditor class="mt-1" v-model="form.description" />

                        <jet-input-error
                            :message="form.errors.description"
                            class="mt-2"
                        />
                    </div>

                    <div class="mt-4">
                        <jet-button
                            v-on:click="saveArticle"
                            type="submit"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Save
                        </jet-button>
                    </div>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Breadcrumbs from "@/Components/Breadcrumbs";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import AppImage from "@/Components/Image";
import AppCkeditor from "@/Components/Ckeditor";
import { strSlug } from "@/helpers.js";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        AppLayout,
        JetInput,
        JetInputError,
        JetLabel,
        Breadcrumbs,
        JetSecondaryButton,
        JetButton,
        AppImage,
        AppCkeditor,
    },
    props: {
        edit: Boolean,
        article: Object,
        categories: {
            type: Object,
            default: function () {
                return {
                    data: [],
                };
            },
        },
        errors: Object,
    },
    data() {
        return {
            imageUrl: "",
            // photoPreview: null,
            // form: this.$inertia.form(
            //     {
            //         _method: this.edit ? "PUT" : "",
            //         category_id: "",
            //         title: "",
            //         slug: "",
            //         description: this.edit ? this.article.data.description : "",
            //         image: "",
            //     },
            //     {
            //         resetOnSuccess: false,
            //     }
            // ),
        };
    },
    setup(props) {
        const form = useForm({
            // _method: this.edit ? "PUT" : "",
            category_id: "",
            title: "",
            slug: "",
            description: props.edit ? props.article.data.description : "",
            image: null,
        });

        return {
            form,
        };
    },
    computed: {
        breadcrumbs() {
            return [
                {
                    label: "Articles",
                    url: this.route("articles.index"),
                },
                {
                    label: "Add Article",
                },
            ];
        },
    },
    methods: {
        saveArticle() {
            console.log(JSON.stringify(this.form, null, 2));
            this.edit
                ? this.form.put(
                      route("articles.update", { id: this.article.data.id })
                  )
                : this.form.post(route("articles.store"));
        },
    },
    watch: {
        "form.title"(title) {
            if (this.edit) return;
            this.form.slug = strSlug(title);
        },
    },
    mounted() {
        if (this.edit) {
            this.form.category_id = this.article.data.category_id;
            this.form.title = this.article.data.title;
            this.form.slug = this.article.data.slug;
            //this.imageUrl = this.article.data.image_url;
        }
        this.imageUrl = this.article.data.image_url;
        console.log(this.imageUrl);
    },
};
</script>

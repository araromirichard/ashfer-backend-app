<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Category
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                >
                    <form>
                        <div>
                            <jet-label for="name" value="name" />
                            <jet-input
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                autocomplete="name"
                            />
                            <jet-input-error
                                :message="form.error('name')"
                                class="mt-2"
                            />
                        </div>

                        <!-- slug -->

                        <div>
                            <jet-label for="slug" value="slug" />
                            <jet-input
                                id="slug"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.slug"
                                autocomplete="slug"
                            />
                            <jet-input-error
                                :message="form.error('slug')"
                                class="mt-2"
                            />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import jetButton from "@/Jetstream/Button.vue";
import jetLabel from "@/Jetstream/Label.vue";
import jetInput from "@/Jetstream/Input.vue";
import jetInputError from "@/Jetstream/InputError.vue";

export default {
    components: {
        AppLayout,
        jetButton,
        jetInput,
        jetInputError,
        jetLabel,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: "",
                slug: "",
            }),
        };
    },
};
</script>

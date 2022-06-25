<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <jet-button :href="route('categories.create')">
                    Add New
                </jet-button>
                <div
                    class="mt-4 p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                >
                    <AppTable :headers="headers">
                        <tr
                            v-for="category in categories.data"
                            :key="category.id"
                        >
                            <td>
                                {{ category.name }}
                            </td>
                            <td>
                                <div
                                    class="flex items-center justify-end space-x-2"
                                >
                                    <EditBtn
                                        :url="
                                            route('categories.edit', {
                                                category: category.id,
                                            })
                                        "
                                    />
                                    <DeleteBtn
                                        :url="
                                            route('categories.destroy', {
                                                category: category.id,
                                            })
                                        "
                                        module-name="category"
                                    />
                                </div>
                            </td>
                        </tr>
                    </AppTable>

                    <div class="mt-4">
                        <SimplePagination
                            :prev-url="categories.links.prev"
                            :next-url="categories.links.next"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import jetButton from "@/Jetstream/Button.vue";
import EditBtn from "../../Components/editBtn.vue";
import DeleteBtn from "../../Components/deleteBtn.vue";
import SimplePagination from "../../Components/SimplePagination.vue";
import AppTable from "../../Components/Table.vue";

export default {
    components: {
        DeleteBtn,
        EditBtn,
        AppLayout,
        Welcome,
        SimplePagination,
        AppTable,
        jetButton,
    },
    props: {
        categories: {},
    },
    computed: {
        headers() {
            return [
                {
                    name: "Name",
                },
                {
                    name: "Action",
                    class: "text-right",
                },
            ];
        },
    },
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <Container>
            <jet-button :href="route('categories.create')">Add new</jet-button>
            <Card class="mt-4">
                <AppTable :headers="headers">
                    <tr v-for="category in categories.data" :key="category.id">
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
            </Card>
        </Container>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import EditBtn from "../../Components/editBtn.vue";
import DeleteBtn from "../../Components/deleteBtn.vue";
import SimplePagination from "../../Components/SimplePagination.vue";
import AppTable from "../../Components/Table.vue";
import JetButton from "@/Jetstream/Button";
import Container from "../../Components/Container.vue";
import Card from "../../Components/Card.vue";

export default {
    components: {
        DeleteBtn,
        EditBtn,
        AppLayout,
        Welcome,
        SimplePagination,
        AppTable,
        JetButton,
        Container,
        Card,
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

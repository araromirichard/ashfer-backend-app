<template>
    <AppLayout title="Dashboard">
        <template #header>
            <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
        </template>

        <Container>
            <jet-button :href="route('categories.create')">Add new</jet-button>
            <Card class="mt-4">
                <AppTable :headers="headers" :items="categories">
                    <tr v-for="category in categories.data" :key="category.id">
                        <td>
                            {{ category.name }}
                        </td>
                        <td>
                            {{ category.created_at_for_human }}
                        </td>
                        <td>
                            <div class="flex items-center justify-end space-x-2">
                                <EditBtn :url="route('categories.edit', {
                                    category: category.id,
                                })
                                    " />
                                <DeleteBtn :url="route('categories.destroy', {
                                    category: category.id,
                                })
                                    " module-name="category" />
                            </div>
                        </td>
                    </tr>
                </AppTable>
            </Card>
        </Container>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import EditBtn from "../../Components/editBtn.vue";
import DeleteBtn from "../../Components/deleteBtn.vue";

import AppTable from "../../Components/Table.vue";
import JetButton from "@/Jetstream/Button";
import Container from "../../Components/Container.vue";
import Card from "../../Components/Card.vue";
import Breadcrumbs from "../../Components/Breadcrumbs.vue";

export default {
    components: {
        DeleteBtn,
        EditBtn,
        AppLayout,
        Welcome,
        AppTable,
        JetButton,
        Container,
        Card,
        Breadcrumbs,
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
                    name: "Created Date",
                },
                {
                    name: "Action",
                    class: "text-right",
                },
            ];
        },

        breadcrumbs() {
            return [
                {
                    label: "Categories",
                },
            ];
        },
    },

    // mounted() {
    //     console.log("hello");
    // },
};
</script>

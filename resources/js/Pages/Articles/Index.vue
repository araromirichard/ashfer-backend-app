<template>
    <AppLayout title="Dashboard">
        <template #header>
            <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
        </template>

        <Container>
            <jet-button :href="route('articles.create')">Add new</jet-button>
            <Card class="mt-4">
                <AppTable :headers="headers" :items="articles">
                    <tr v-for="article in articles.data" :key="article.id">
                        <td>
                            {{ article.title }}
                        </td>

                        <td>
                            {{ article.category.name }}
                        </td>
                        <td>
                            <select class="border-transparent focus:border-transparent">
                                <option v-for="tag in article.tags" :key="tag.id">{{ tag.name }}</option>
                            </select>
                        </td>
                        <td>
                            {{ article.created_at_for_human }}
                        </td>
                        <td>
                            <div class="flex items-center justify-end space-x-2">
                                <EditBtn :url="route('articles.edit', {
                                    article: article.id,
                                })
                                    " />
                                <DeleteBtn :url="route('articles.destroy', {
                                    article: article.id,
                                })
                                    " module-name="article" />
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
        articles: {},
    },
    computed: {
        headers() {
            return [
                {
                    name: "Title",
                },
                {
                    name: "Category",
                },
                {
                    name: "Tags",
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
                    label: "Articles",
                },
            ];
        },
    },

    // mounted() {
    //     console.log(JSON.stringify(this.articles.data[0].category, null, 2));
    // },
};
</script>

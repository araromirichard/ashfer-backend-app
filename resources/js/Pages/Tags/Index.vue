<template>
    <AppLayout title="Dashboard">
        <template #header>
            <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
        </template>

        <Container>
            <jet-button :href="route('tags.create')">Add new</jet-button>
            <Card class="mt-4">
                <AppTable :headers="headers" :items="tags">
                    <tr v-for="tag in tags.data" :key="tag.id">
                        <td>
                            {{ tag.name }}
                        </td>
                        <td>
                            {{ tag.slug }}
                        </td>
                        <td>
                            {{ tag.description }}
                        </td>
                        <td>
                            {{ tag.created_at_for_human }}
                        </td>
                        <td>
                            <div class="flex items-center justify-end space-x-2">
                                <EditBtn :url="route('tags.edit', {
                                    tag: tag.id,
                                })
                                    " />
                                <DeleteBtn :url="route('tags.destroy', {
                                    tag: tag.id,
                                })
                                    " module-name="tag" />
                            </div>
                        </td>
                    </tr>
                </AppTable>
            </Card>
        </Container>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import EditBtn from "@/Components/editBtn.vue";
import DeleteBtn from "@/Components/deleteBtn.vue";

import AppTable from "@/Components/Table.vue";
import JetButton from "@/Jetstream/Button";
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import { computed } from "vue";

const props = defineProps({
    tags: {},
});

const headers = computed(() => {
    return [
        {
            name: "Name",
        },
        {
            name: "Slug",
        },
        {
            name: "Description",
        },
        {
            name: "Created Date",
        },
        {
            name: "Action",
            class: "text-right",
        },
    ];
})
const breadcrumbs = computed(() => {
    return [
        {
            label: "Tags",
        },
    ];
})

</script>

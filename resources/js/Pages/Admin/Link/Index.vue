<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
    mdiAccountKey,
    mdiPlus,
    mdiSquareEditOutline,
    mdiTrashCan,
    mdiAlertBoxOutline,
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import BaseButton from "@/Components/BaseButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButtons from "@/Components/BaseButtons.vue"
import NotificationBar from "@/Components/NotificationBar.vue"
import Pagination from "@/Components/Admin/Pagination.vue"
import Sort from "@/Components/Admin/Sort.vue"

const props = defineProps({
    links: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
    can: {
        type: Object,
        default: () => ({}),
    },
})

const form = useForm({
    search: props.filters.search,
})

const formDelete = useForm({})

function destroy(id) {
    if (confirm("Are you sure you want to delete?")) {
        formDelete.delete(route("admin.link.destroy", id))
    }
}
</script>

<template>
    <LayoutAuthenticated>

        <Head title="Links" />
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiAccountKey" title="ShortLinks" main>
                <!-- <BaseButton v-if="can.delete" :route-name="route('admin.link.create')" :icon="mdiPlus" label="Add"
                    color="info" rounded-full small /> -->
            </SectionTitleLineWithButton>
            <NotificationBar :key="Date.now()" v-if="$page.props.flash.message" color="success" :icon="mdiAlertBoxOutline">
                {{ $page.props.flash.message }}
            </NotificationBar>
            <CardBox class="mb-6" has-table>
                <form @submit.prevent="form.get(route('admin.link.index'))">
                    <div class="py-2 flex">
                        <div class="flex pl-4">
                            <input type="search" v-model="form.search" class="
                  rounded-md
                  shadow-sm
                  border-gray-300
                  focus:border-indigo-300
                  focus:ring
                  focus:ring-indigo-200
                  focus:ring-opacity-50
                " placeholder="Search" />
                            <BaseButton label="Search" type="submit" color="info"
                                class="ml-4 inline-flex items-center px-4 py-2" />
                        </div>
                    </div>
                </form>
            </CardBox>
            <CardBox class="mb-6" has-table>
                <table>
                    <thead>
                        <tr>
                            <th>
                                <Sort label="Name" attribute="name" />
                            </th>
                            <th v-if="can.edit || can.delete">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="link in links.data" :key="link.id">
                            <td data-label="Name">
                                <p>
                                    {{ link.name }}
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="py-4">
                    <Pagination :data="links" />
                </div>
            </CardBox>
            this is text
        </SectionMain>
    </LayoutAuthenticated>
</template>


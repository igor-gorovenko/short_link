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
import Clipboard from 'clipboard'

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
        formDelete.delete(route("admin.shortlink.destroy", id))
    }
}

const setupClipboard = (textToCopy) => {
    // Created new object Clipboard.js and take text for copy
    const clipboard = new Clipboard('.base-button', {
        text: () => textToCopy,
    });

    clipboard.on('success', (e) => {
        console.log('Link copied!');
        e.clearSelection();
    });

    clipboard.on('error', (e) => {
        console.error('Copy failed:', e.action);
    });
}

const onButtonClick = (link) => {
    setupClipboard(link.default_short_url);
}
</script>

<template>
    <LayoutAuthenticated>

        <Head title="Links" />
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiAccountKey" title="ShortLinks" main>
                <BaseButton v-if="can.delete" :route-name="route('admin.shortlink.create')" :icon="mdiPlus" label="Add"
                    color="info" rounded-full small />
            </SectionTitleLineWithButton>
            <NotificationBar :key="Date.now()" v-if="$page.props.flash.message" color="success" :icon="mdiAlertBoxOutline">
                {{ $page.props.flash.message }}
            </NotificationBar>
            <CardBox class="mb-6" has-table>
                <form @submit.prevent="form.get(route('admin.shortlink.index'))">
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
                                <Sort label="Shortlink" attribute="Default_short_url" />
                            </th>
                            <th>
                                <Sort label="Url Key" attribute="Url_key" />
                            </th>
                            <th>
                                <Sort label="Destination Url" attribute="Destination_url" />
                            </th>
                            <th v-if="can.edit || can.delete">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="link in links.data" :key="link.id">
                            <td data-label="Default_short_url">
                                <Link :href="route('admin.shortlink.show', link.id)" class="
                    no-underline
                    hover:underline
                    text-cyan-600
                    dark:text-cyan-400
                  ">
                                {{ link.default_short_url }}
                                </Link>
                            </td>
                            <td data-label="Url_key">
                                {{ link.url_key }}

                            </td>
                            <td data-label="Destination_url">
                                {{ link.destination_url }}
                            </td>
                            <td v-if="can.edit || can.delete" class="before:hidden lg:w-1 whitespace-nowrap">
                                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                                    <BaseButton label="Copy Short URL" color="white" class="base-button"
                                        @click="() => onButtonClick(link)" small />
                                    <BaseButton v-if="can.edit" :route-name="route('admin.shortlink.edit', link.id)"
                                        color="info" :icon="mdiSquareEditOutline" small />
                                    <BaseButton v-if="can.delete" color="danger" :icon="mdiTrashCan" small
                                        @click="destroy(link.id)" />
                                </BaseButtons>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="py-4">
                    <Pagination :data="links" />
                </div>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>


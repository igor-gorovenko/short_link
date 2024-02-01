<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
    mdiAccountKey,
    mdiArrowLeftBoldOutline,
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import BaseButton from "@/Components/BaseButton.vue"
import CardBox from "@/Components/CardBox.vue"
import Pagination from "@/Components/Admin/Pagination.vue"
import Sort from "@/Components/Admin/Sort.vue"

const props = defineProps({
    link: {
        type: Object,
        default: () => ({}),
    },
    visits: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
})
</script>

<template>
    <LayoutAuthenticated>

        <Head title="Statistics" />
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiAccountKey" title="View Statistics" main>
                <BaseButton :route-name="route('admin.shortlink.show', link.id)" :icon="mdiArrowLeftBoldOutline"
                    label="Back" color="white" rounded-full small />
            </SectionTitleLineWithButton>
            <CardBox class="mb-6" has-table>
                <table>
                    <thead>
                        <tr>
                            <th>
                                <Sort label="Short Url ID" attribute="Short_url_id" />
                            </th>
                            <th>
                                <Sort label="IP address" attribute="IP_address" />
                            </th>
                            <th>
                                <Sort label="OS" attribute="operating_system" />
                            </th>
                            <th>
                                <Sort label="OS version" attribute="operating_system_version" />
                            </th>
                            <th>
                                <Sort label="Browser" attribute="browser" />
                            </th>
                            <th>
                                <Sort label="Browser version" attribute="browser_version" />
                            </th>
                            <th>
                                <Sort label="Device" attribute="device_type" />
                            </th>
                            <th>
                                <Sort label="Referer URL" attribute="referer_url" />
                            </th>
                            <th>
                                <Sort label="Visited at" attribute="visited_at" />
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="visit in visits.data" :key="visit.id">
                            <td data-label="Default_short_url">
                                {{ visit.short_url_id }}
                            </td>
                            <td data-label="IP_address">
                                {{ visit.ip_address }}
                            </td>
                            <td data-label="operating_system">
                                {{ visit.operating_system }}
                            </td>
                            <td data-label="operating_system_version">
                                {{ visit.operating_system_version }}
                            </td>
                            <td data-label="browser">
                                {{ visit.browser }}
                            </td>
                            <td data-label="browser_version">
                                {{ visit.browser_version }}
                            </td>
                            <td data-label="device_type">
                                {{ visit.device_type }}
                            </td>
                            <td data-label="referer_url">
                                {{ visit.referer_url }}
                            </td>
                            <td data-label="visited_at">
                                {{ visit.visited_at }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="py-4">
                    <Pagination :data="visits" />
                </div>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>nticated>
</template>

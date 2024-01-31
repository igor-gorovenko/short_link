<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
    mdiAccountKey,
    mdiArrowLeftBoldOutline
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButton from '@/Components/BaseButton.vue'

const props = defineProps({
    link: {
        type: Object,
        default: () => ({}),
    },
})
</script>

<template>
    <LayoutAuthenticated>

        <Head title="View shortlink" />
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiAccountKey" title="View shortlink" main>
                <BaseButton :route-name="route('admin.shortlink.index')" :icon="mdiArrowLeftBoldOutline" label="Back"
                    color="white" rounded-full small />
            </SectionTitleLineWithButton>
            <CardBox class="mb-6">
                <table>
                    <tbody>
                        <tr>
                            <td class="
                  p-4
                  pl-8
                  text-slate-500
                  dark:text-slate-400
                  hidden
                  lg:block
                ">
                                Shortlink
                            </td>
                            <td data-label="Short_url">
                                {{ link.default_short_url }}
                            </td>
                        </tr>
                        <tr>
                            <td class="
                  p-4
                  pl-8
                  text-slate-500
                  dark:text-slate-400
                  hidden
                  lg:block
                ">
                                Url Key
                            </td>
                            <td data-label="Url_key">
                                {{ link.url_key }}
                            </td>
                        </tr>
                        <tr>
                            <td class="
                  p-4
                  pl-8
                  text-slate-500
                  dark:text-slate-400
                  hidden
                  lg:block
                ">
                                Destination Url
                            </td>
                            <td data-label="Destination_url">
                                {{ link.destination_url }}
                            </td>
                        </tr>

                        <tr>
                            <td class="
                  p-4
                  pl-8
                  text-slate-500
                  dark:text-slate-400
                  hidden
                  lg:block
                ">
                                Created
                            </td>
                            <td data-label="Created">
                                {{ new Date(link.created_at).toLocaleString() }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <template #footer>
                    <BaseButtons>
                        <BaseButton :route-name="route('admin.shortlink.statistics', link.id)" label="Statistics"
                            color="info" rounded />
                    </BaseButtons>
                </template>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>

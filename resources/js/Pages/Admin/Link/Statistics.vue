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

        <Head title="Statistics" />
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiAccountKey" title="View Statistics" main>
                <BaseButton :route-name="route('admin.shortlink.show', link.id)" :icon="mdiArrowLeftBoldOutline"
                    label="Back" color="white" rounded-full small />
            </SectionTitleLineWithButton>
            <CardBox class="mb-6">
                this is statistics page
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>nticated>
</template>

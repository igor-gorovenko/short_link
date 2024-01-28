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
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'

const form = useForm({
    name: '',
})
</script>

<template>
    <LayoutAuthenticated>

        <Head title="Create short link" />
        <SectionMain>
            this is edit page
        </SectionMain>
    </LayoutAuthenticated>
</template>

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

const props = defineProps({
    link: {
        type: Object,
        default: () => ({}),
    }
})

const form = useForm({
    _method: 'put',
    url_key: props.link.url_key,
    destination_url: props.link.destination_url,
})
</script>

<template>
    <LayoutAuthenticated>

        <Head title="Update shortlink" />
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiAccountKey" title="Update shortlink" main>
                <BaseButton :route-name="route('admin.shortlink.index')" :icon="mdiArrowLeftBoldOutline" label="Back"
                    color="white" rounded-full small />
            </SectionTitleLineWithButton>
            <CardBox form @submit.prevent="form.post(route('admin.shortlink.update', props.link.id))">
                <FormField label="Url Key" :class="{ 'text-red-400': form.errors.url_key }">
                    <FormControl v-model="form.url_key" type="text" placeholder="Enter Url key"
                        :error="form.errors.url_key">
                        <div class="text-red-400 text-sm" v-if="form.errors.url_key">
                            {{ form.errors.url_key }}
                        </div>
                    </FormControl>
                </FormField>
                <FormField label="Destination Url" :class="{ 'text-red-400': form.errors.destination_url }">
                    <FormControl v-model="form.destination_url" type="text" placeholder="Enter Destination Url"
                        :error="form.errors.destination_url">
                        <div class="text-red-400 text-sm" v-if="form.errors.destination_url">
                            {{ form.errors.destination_url }}
                        </div>
                    </FormControl>
                </FormField>
                <template #footer>
                    <BaseButtons>
                        <BaseButton type="submit" color="info" label="Submit" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing" />
                    </BaseButtons>
                </template>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>

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
    url_key: '',
    destination_url: '',
    generated_shortlink: '',
})
</script>

<template>
    <LayoutAuthenticated>

        <Head title="Create shortlink" />
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiAccountKey" title="Add shortlink" main>
                <BaseButton :route-name="route('admin.shortlink.index')" :icon="mdiArrowLeftBoldOutline" label="Back"
                    color="white" rounded-full small />
            </SectionTitleLineWithButton>
            <CardBox form @submit.prevent="form.post(route('admin.shortlink.store'))">
                <FormField label="Url_key" :class="{ 'text-red-400': form.errors.url_key }">
                    <FormControl v-model="form.url_key" type="text" placeholder="Enter Url_key"
                        :error="form.errors.url_key">
                        <div class="text-red-400 text-sm" v-if="form.errors.url_key">
                            {{ form.errors.url_key }}
                        </div>
                    </FormControl>
                </FormField>
                <FormField label="Destination_url" :class="{ 'text-red-400': form.errors.destination_url }">
                    <FormControl v-model="form.destination_url" type="text" placeholder="Enter Destination_url"
                        :error="form.errors.destination_url">
                        <div class="text-red-400 text-sm" v-if="form.errors.destination_url">
                            {{ form.errors.destination_url }}
                        </div>
                    </FormControl>
                </FormField>
                <FormField label="Shortlink" :class="{ 'text-red-400': form.errors.generated_shortlink }">
                    <FormControl v-model="form.generated_shortlink" type="text" placeholder="Enter Shortlink"
                        :error="form.errors.generated_shortlink">
                        <div class="text-red-400 text-sm" v-if="form.errors.generated_shortlink">
                            {{ form.errors.generated_shortlink }}
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

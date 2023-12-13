<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '../../Components/UI/Box.vue'
defineProps({
    listing: Object,
})
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Details
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
                            <Box class="md:col-span-7 flex items-center">
                                <div class="w-full text-center font-medium text-gray-500">No images</div>
                            </Box>
                            <div class="md:col-span-5 flex flex-col gap-4">
                                <Box>
                                    <template #header>
                                        Basic info
                                    </template>
                                    <Price :price="listing.price" class="text-2xl font-bold" />
                                    <ListingSpace :listing="listing" class="text-lg" />
                                    <ListingAddress :listing="listing" class="text-gray-500" />
                                </Box>

                                <Box>
                                    <template #header>
                                        Offer
                                    </template>
                                    Make an offer
                                </Box>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

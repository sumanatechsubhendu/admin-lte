<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'
import ListingAddress from '@/Components/ListingAddress.vue'
import Box from '@/Components/UI/Box.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
defineProps({
    listings: Array,
})
</script>
<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Property Listing
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <a :href="route('listing.create')">
                        <BreezeButton class="ml-4">
                            Add Property
                        </BreezeButton>
                    </a>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                            <Box v-for="listing in listings" :key="listing.id">
                                <div>
                                    <Link :href="route('listing.show', { listing: listing.id })">
                                    <Price :price="listing.price" class="text-2xl font-bold" />
                                    <ListingSpace :listing="listing" class="text-lg" />
                                    <ListingAddress :listing="listing" class="text-gray-500" />
                                    </Link>
                                </div>
                                <div>
                                    <Link :href="route('listing.edit', { listing: listing.id })">
                                    Edit
                                    </Link>
                                </div>
                                <div>
                                    <Link :href="route('listing.destroy', { listing: listing.id })" method="DELETE"
                                        as="button">
                                    Delete
                                    </Link>
                                </div>
                            </Box>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

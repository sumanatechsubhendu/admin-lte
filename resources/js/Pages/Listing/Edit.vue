<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
  listing: Object,
})
const form = useForm({
  beds: props.listing.beds,
  baths: props.listing.baths,
  area: props.listing.area,
  city: props.listing.city,
  street: props.listing.street,
  code: props.listing.code,
  street_nr: props.listing.street_nr,
  price: props.listing.price,
})
const update = () => form.put(route('listing.update', {listing: props.listing.id}))
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="update">
                            <div class="grid grid-cols-6 gap-4">
                                <div class="col-span-2">
                                    <label class="label">Beds</label>
                                    <input v-model.number="form.beds" type="text" class="input" />
                                    <div v-if="form.errors.beds">
                                        {{ form.errors.beds }}
                                    </div>
                                </div>

                                <div class="col-span-2">
                                    <label class="label">Baths</label>
                                    <input v-model.number="form.baths" type="text" class="input" />
                                    <div v-if="form.errors.baths">
                                        {{ form.errors.baths }}
                                    </div>
                                </div>

                                <div class="col-span-2">
                                    <label class="label">Area</label>
                                    <input v-model.number="form.area" type="text" class="input" />
                                    <div v-if="form.errors.area">
                                        {{ form.errors.area }}
                                    </div>
                                </div>

                                <div class="col-span-4">
                                    <label class="label">City</label>
                                    <input v-model="form.city" type="text" class="input" />
                                    <div v-if="form.errors.city">
                                        {{ form.errors.city }}
                                    </div>
                                </div>

                                <div class="col-span-2">
                                    <label class="label">Post Code</label>
                                    <input v-model="form.code" type="text" class="input" />
                                    <div v-if="form.errors.code">
                                        {{ form.errors.code }}
                                    </div>
                                </div>

                                <div class="col-span-4">
                                    <label class="label">Street</label>
                                    <input v-model="form.street" type="text" class="input" />
                                    <div v-if="form.errors.street">
                                        {{ form.errors.street }}
                                    </div>
                                </div>

                                <div class="col-span-2">
                                    <label class="label">Street Nr</label>
                                    <input v-model.number="form.street_nr" type="text" class="input" />
                                    <div v-if="form.errors.street_nr">
                                        {{ form.errors.street_nr }}
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <label class="label">Price</label>
                                    <input v-model.number="form.price" type="text" class="input" />
                                    <div v-if="form.errors.price">
                                        {{ form.errors.price }}
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Update
                                    </BreezeButton>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<style scoped>
label {
    margin-right: 2em;
}

div {
    padding: 2px
}
</style>

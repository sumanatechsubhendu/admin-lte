<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="editPost">
                            <div>
                                <label for="title">Title</label>
                                <input type="text" v-model="form.title" @keyup="convertToSlug" class="
                                    w-full
                                    px-4
                                    py-2
                                    mt-2
                                    border
                                    rounded-md
                                    focus:outline-none
                                    focus:ring-1
                                    focus:ring-blue-600
                                " />
                                <div v-if="form.errors.title">{{ form.errors.title }}</div>
                            </div>
                            <div>
                                <label for="title">Slug</label>
                                <input type="text" v-model="form.slug" class="
                                    w-full
                                    px-4
                                    py-2
                                    mt-2
                                    border
                                    rounded-md
                                    focus:outline-none
                                    focus:ring-1
                                    focus:ring-blue-600
                                " />
                                <div v-if="form.errors.slug">{{ form.errors.slug }}</div>
                            </div>
                            <div class="mt-4">
                                <label for="title">Description</label>
                                <textarea name="description" type="text" v-model="form.description" class="
                                    w-full
                                    px-4
                                    py-2
                                    mt-2
                                    border
                                    rounded-md
                                    focus:outline-none
                                    focus:ring-1
                                    focus:ring-blue-600
                                ">
                                </textarea>
                                <div v-if="form.errors.description">{{ form.errors.description }}</div>
                            </div>
                            <!-- submit -->
                            <div class="flex items-center mt-4">
                                <button class="
                                    px-6
                                    py-2
                                    text-white
                                    bg-gray-900
                                    rounded
                                ">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    setup(props) {
        const form = useForm({
            title: props.post.title,
            slug: props.post.slug,
            description: props.post.description,
        });

        return { form };
    },
    props: {
        post: Object,
    },
    methods: {
        editPost() {
            this.form.put(route("posts.update", this.post.id));
        },
        convertToSlug() {
            // Convert title to slug
            this.form.slug = this.form.title
                .toLowerCase()
                .replace(/ /g, '-') // Replace spaces with hyphens
                .replace(/[^\w-]+/g, ''); // Remove non-word characters except hyphens
        },
    },
};
</script>

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
                        <Form :form="form" @submit="editPost" />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Form from "@/Pages/Post/Partials/form.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Form
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
    },
};
</script>

<template>
    <form @submit.prevent="add">
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
</template>

<script>
export default {
  props: {
    form: Object, // Assuming you pass the form object as a prop
  },
  methods: {
    convertToSlug() {
        // Convert title to slug
        this.form.slug = this.form.title
            .toLowerCase()
            .replace(/ /g, '-') // Replace spaces with hyphens
            .replace(/[^\w-]+/g, ''); // Remove non-word characters except hyphens
    },
    submit() {
      // Handle form submission
      this.$emit('submit'); // Emit an event to notify the parent component
    },
  },
};
</script>

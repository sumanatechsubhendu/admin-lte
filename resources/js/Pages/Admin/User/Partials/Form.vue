<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AdminLayout.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Form from "@/Pages/Admin/User/Partials/Form.vue";
import { ref } from 'vue';

const props = defineProps({
    roleList: Object,
    user: Object,
    role: String,
    form: Object,
});

const status_options = ref([
  { text: 'Active', value: '1' },
  { text: 'Inactive', value: '0' }
]);

const emit = defineEmits(['submit'])

const create = () => {
    emit('submit');
};
</script>
<template>
    <form @submit.prevent="create">
        <div>
            <BreezeLabel for="first_name" value="First Name" />
            <BreezeInput id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" autofocus autocomplete="first_name" />
            <div class="mb-4 font-medium text-sm text-red-600" v-if="form.errors.first_name">{{ form.errors.first_name }}</div>
        </div>

        <div>
            <BreezeLabel for="last_name" value="Last Name" />
            <BreezeInput id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" autofocus autocomplete="last_name" />
            <div class="mb-4 font-medium text-sm text-red-600" v-if="form.errors.last_name">{{ form.errors.last_name }}</div>
        </div>

        <div class="mt-4">
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" autocomplete="username" />
            <div class="mb-4 font-medium text-sm text-red-600" v-if="form.errors.email">{{ form.errors.email }}</div>
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Password" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" autocomplete="new-password" />
            <div class="mb-4 font-medium text-sm text-red-600" v-if="form.errors.password">{{ form.errors.password }}</div>
        </div>

        <div class="mt-4">
            <BreezeLabel for="password_confirmation" value="Confirm Password" />
            <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" autocomplete="new-password" />
            <div class="mb-4 font-medium text-sm text-red-600" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</div>
        </div>

        <div class="mt-4">
            <BreezeLabel for="status" value="Status" />
            <select id="status" v-model="form.status" class="mt-1 block w-full">
                <option v-for="option in status_options" :value="option.value">
                    {{ option.text }}
                </option>
            </select>
            <div class="mb-4 font-medium text-sm text-red-600" v-if="form.errors.status">{{ form.errors.status }}</div>
        </div>

        <div class="mt-4">
            <BreezeLabel for="role_id" value="Role" />
            <select id="role_id" v-model="form.role_id" class="mt-1 block w-full">
                <option value="" disabled>Select Role</option>
                <option v-for="(role, roleId) in props.roleList" :key="roleId" :value="role">
                    {{ role }}
                </option>
            </select>
            <div class="mb-4 font-medium text-sm text-red-600" v-if="form.errors.role_id">{{ form.errors.role_id }}</div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Add
            </BreezeButton>
        </div>
    </form>
</template>

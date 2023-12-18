<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AdminLayout.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    roleList: Object,
    user: Object,
    status: String,
})
const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    email: props.user.email,
    password: '',
    password_confirmation: '',
    role_id: props.user.role_id,
    status: props.user.status
});

const update = () => form.put(route('users.update', { user: props.user.id }))
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit Users</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-header">
                                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                                        {{ status }}
                                    </div>
                                </div>
                                <div class="card-body" id="table1">
                                    <form @submit.prevent="update">
                                        <div>
                                            <BreezeLabel for="first_name" value="First Name" />
                                            <BreezeInput id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" required autofocus autocomplete="first_name" />
                                        </div>

                                        <div>
                                            <BreezeLabel for="last_name" value="Last Name" />
                                            <BreezeInput id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" required autofocus autocomplete="last_name" />
                                        </div>

                                        <div class="mt-4">
                                            <BreezeLabel for="email" value="Email" />
                                            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                                        </div>

                                        <div class="mt-4">
                                            <BreezeLabel for="password" value="Password" />
                                            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" autocomplete="new-password" />
                                        </div>

                                        <div class="mt-4">
                                            <BreezeLabel for="password_confirmation" value="Confirm Password" />
                                            <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" autocomplete="new-password" />
                                        </div>

                                        <div class="mt-4">
                                            <BreezeLabel for="status" value="Status" />
                                            <select id="status" v-model="form.status" class="mt-1 block w-full" required>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="mt-4">
                                            <BreezeLabel for="role_id" value="Role" />
                                            <select id="role_id" v-model="form.role_id" class="mt-1 block w-full" required>
                                                <option value="" disabled>Select Role</option>
                                                <option v-for="(role, roleId) in props.roleList" :key="roleId" :value="roleId">
                                                    {{ role }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Update
                                            </BreezeButton>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
        </div>
        <!-- /.content-wrapper -->
    </BreezeAuthenticatedLayout>
</template>

<style>
#dataTable2 {
    width: 100% !important;
}

.dataTable {
    width: 100% !important;
}
</style>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Form from "@/Pages/Admin/User/Partials/Form.vue";
import BreezeButton from '@/Components/Button.vue';
import { ref } from 'vue';

const props = defineProps({
    roleList: Object,
})
const userForm = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role_id: '',
    status: ref(0)
});

const create = () => {
    userForm.post(route('users.store'), {
        onFinish: () => userForm.reset('password', 'password_confirmation'),
    });
};
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
                            <h1>Add User</h1>
                        </div>
                        <div class="col-sm-6  flex items-center justify-end">
                            <Link :href="route('users.index')">
                                <BreezeButton class="ml-4">
                                    Go Back
                                </BreezeButton>
                            </Link>
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
                                <div class="card-body" id="table1">
                                    <Form :form="userForm" :roleList=props.roleList @submit="create" />
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

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AdminLayout.vue';
import { Head } from "@inertiajs/inertia-vue3";
import BreezeButton from '@/Components/Button.vue';
import { Link } from "@inertiajs/inertia-vue3";
import Swal from 'sweetalert2';
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
                            <h1>Users</h1>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <BreezeButton class="ml-4" @click="create">
                                Add User
                            </BreezeButton>
                            <BreezeButton class="ml-4" id="refreshBtn" @click="refresh">
                                Refresh
                            </BreezeButton>
                            <!-- <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Users</li>
                                </ol> -->
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">List of all users {{ status }}</h3>
                                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                                        {{ status }}
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" id="table1">
                                    <input type="hidden" name="baseUrl" id="baseUrl" v-model="baseUrl" />
                                    <input type="hidden" name="token" id="token" v-model="token" />
                                    <table class="table table-bordered table-hover w-full" id="dataTable2">
                                        <thead>
                                            <tr>
                                                <th class="whitespace-nowrap">Name</th>
                                                <th class="whitespace-nowrap">Email Id</th>
                                                <th class="whitespace-nowrap">Role</th>
                                                <th class="whitespace-nowrap">Status</th>
                                                <th class="whitespace-nowrap">Created On</th>
                                                <th class="whitespace-nowrap">Action</th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr></tr>
                                        </tfoot>
                                    </table>
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
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </BreezeAuthenticatedLayout>
</template>

<script>
import $ from 'jquery';

export default {
    props: {
        users: Array,
        token: String,
        status: String,
    },
    data() {
        return {
            apiData: {},
            baseUrl: window.location.origin,
        };
    },
    mounted() {
        this.fetchDataFromApi();
    },
    methods: {
        async fetchDataFromApi() {
            try {
                //const response = await this.$axios.get('/user-list');
                // Replace the URL with your API endpoint
                let role_id = null;
                let start_date = null;
                let end_date = null;
                this.drawTable(role_id, start_date, end_date);

            } catch (error) {
                console.error('Error fetching data from API', error);
            }
        },
        create() {
            const addUserUrl = this.baseUrl + '/webpanel/users/create';
            window.location.href = addUserUrl;
        },
        refresh() {
            let role_id = null;
            let start_date = null;
            let end_date = null;
            $('#dataTable2').DataTable().destroy();
            this.drawTable(role_id, start_date, end_date);
        },
        destroy(id) {
            // Ask for confirmation
            const isConfirmed = window.confirm("Are you sure you want to delete this post?");

            // If user confirms, proceed with deletion
            if (isConfirmed) {
                this.$inertia.delete(route("users.destroy", id));
            }
        },
        drawTable(role_id, start_date, end_date) {
            const apiUrl = this.baseUrl + '/user-list';
            $('#table1').hide();
            $('#dataTable2').DataTable({
                'scrollX': true,
                'fixedColumns': {
                    left: 1,
                    right: 0
                },
                "bStateSave": true,
                "fnStateSave": function(oSettings, oData) {
                    localStorage.setItem('offersDataTables', JSON.stringify(oData));
                },
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'language': {
                    "emptyTable": "No Data Found."
                },

                initComplete: function() {
                    $('.dataTable').css('width', '100%');
                    $('#table1').css('width', '100%'); // Set the table width to 100%
                },
                'ajax': {
                    'url': apiUrl,
                    "data": {
                        "_token": this.token,
                        "role_id": role_id,
                        "end_date": end_date,
                        "start_date": start_date
                    },
                    beforeSend: function() {
                        $("#loaderDiv1").show();
                    },
                    complete: (data) => {
                        $("#loaderDiv1").hide();
                        $('#table1').show();
                        $('.table').resize();
                        $(".dataTables_paginate .pagination li").addClass("page-item");
                        $(".dataTables_paginate .pagination li a").addClass("page-link");
                        $(".dataTables_paginate .pagination li a:first").html('<span aria-hidden="true">«</span>');
                        $(".dataTables_paginate .pagination li a:last").html('<span aria-hidden="true">»</span>');
                        $('.delete-btn').click(async function() {
                            var userId = $(this).data('id');
                            var baseUrl = $("#baseUrl").val();
                            var token = $("#token").val();

                            // Ask for confirmation
                            const result = await Swal.fire({
                                title: 'Are you sure you want to delete this user?',
                                text: 'You won\'t be able to revert this!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Yes, delete it!'
                            });

                            if (result.isConfirmed) {
                                // User clicked "Yes, delete it!" button
                                // Perform the delete logic or call the delete method here
                                const apiUrl = route("delete-user", userId);
                                $.ajax({
                                    url: apiUrl,
                                    type: 'GET',
                                    data: {
                                        _token: token
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': token
                                    },
                                    success: function(response) {
                                        if (response.status == "success") {
                                            Swal.fire('Delete successful');
                                        } else {
                                            Swal.fire('user already deleted.');
                                        }
                                        $('#refreshBtn').click();
                                    },
                                    error: function(error) {
                                        // Handle error response
                                        console.error('Delete failed', error);
                                        Swal.fire('Delete failed');
                                    }
                                });
                            }

                        });
                    },
                },
                'columns': [
                    { data: 'full_name' },
                    { data: 'email' },
                    { data: 'role' },
                    { data: 'status' },
                    { data: 'created_at' },
                    { data: 'action' },
                ],
                rowCallback: function(row, data, index) {

                    // Add class to the row element
                    $(row).addClass('intro-x rounded');

                    // Add class to specific td elements
                    $(row).find('td').addClass('whitespace-nowrap');
                    // $(row).find('td:eq(1)').addClass('custom-td-class-2');
                    // Add more td classes as needed
                },
                createdRow: function(row, data, dataIndex) {
                    // Add class to the row element
                    $(row).addClass('intro-x rounded');

                    // Add class to specific td elements
                    $(row).find('td').addClass('whitespace-nowrap');
                    // $(row).find('td:eq(1)').addClass('custom-td-class-2');
                    // Add more td classes as needed
                },
                columnDefs: [
                    { orderable: false, targets: '_all' }
                ],
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [2] }
                ],
                oLanguage: { sProcessing: "<div id='loader' class='loading'></div>" }
            });
        }
    },
};
</script>

<style>
#dataTable2 {
    width: 100% !important;
}

.dataTable {
    width: 100% !important;
}
</style>

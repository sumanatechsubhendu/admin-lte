<!-- resources/js/Components/Admin/User/UserTable.vue -->

<template>
    <table id="users-table" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th> <!-- Add Action column header -->
            </tr>
        </thead>
        <tbody>
            <!-- Loop through users and display data -->
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.status }}</td>
                <td>
                    <a :href="'/users/' + user.id + '/edit'" class="btn btn-warning btn-sm">
                    <i class="fas fa-pencil" title="Edit"></i>
                    </a>&nbsp;
                    <button @click="deleteUser(user.id)" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash" title="Delete"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import $ from 'jquery';
export default {
    props: {
        users: Array, // Pass users as a prop
    },
    mounted() {
        // Initialize DataTables
        $(document).ready(function () {
            $('#users-table').DataTable();
        });
    },
    methods: {
        editUser(userId) {
            // Handle edit action
            console.log(`Edit user with ID: ${userId}`);
        },
        deleteUser(userId) {
            // Handle delete action
            console.log(`Delete user with ID: ${userId}`);
        },
    },
};
</script>

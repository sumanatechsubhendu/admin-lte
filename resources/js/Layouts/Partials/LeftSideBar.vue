<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ this.baseUrl }}/index3.html" class="brand-link elevation-4">
                    <img :src="`${this.baseUrl}/admin-lte/dist/img/AdminLTELogo.png`" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">Admin Panel</span>
                </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="`${this.baseUrl}/admin-lte/dist/img/user2-160x160.jpg`" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a :href="route('webpanel.dashboard')" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v1</p>
                                        </a>
                            </li>
                            <li class="nav-item">
                                <a :href="route('webpanel.dashboard')" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v2</p>
                                        </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('users.index')" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Users</p>
                        </Link>
                    </li>


                    <li class="nav-item">
                        <Link :href="route('users.create')" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Create User</p>
                        </Link>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
export default {
    data() {
        return {
            baseUrl: window.location.origin,
        };
    },
};
</script>

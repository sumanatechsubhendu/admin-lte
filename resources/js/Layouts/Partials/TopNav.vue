<script setup>
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>
<template>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <Link :href="route('webpanel.dashboard')" :active="route().current('webpanel.dashboard')" class="nav-link">Home</Link>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <Link :href="route('users.index')" :active="route().current('users.index')" class="nav-link">Users</Link>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <BreezeDropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <b>{{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}</b>(<b>{{ $page.props.auth.user.email }}</b>)

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </BreezeDropdownLink>
                            </template>
                        </BreezeDropdown>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
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

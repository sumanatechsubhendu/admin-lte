<script setup>
import Footer from '@/Layouts/Partials/Footer.vue';
import LeftSideBar from '@/Layouts/Partials/LeftSideBar.vue';
import TopNav from '@/Layouts/Partials/TopNav.vue';
</script>

<template>
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <TopNav/>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <LeftSideBar/>

        <!-- Content Wrapper. Contains page content -->
        <slot />
        <!-- /.content-wrapper -->

        <Footer/>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
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

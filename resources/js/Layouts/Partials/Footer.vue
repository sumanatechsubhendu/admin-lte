<template>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2023-2024 <a :href="`${this.baseUrl}`">Admin Dashboard</a>.</strong> All rights reserved.
    </footer>
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

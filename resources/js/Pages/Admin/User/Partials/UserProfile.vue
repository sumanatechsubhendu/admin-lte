<script setup>
const props = defineProps({
    user: Object,
});

const emit = defineEmits(['submit'])

const create = () => {
    emit('submit');
};
</script>

<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div>
                        <p><strong>Full Name:</strong> {{ user.full_name }}</p>
                        <p><strong>Email:</strong> {{ user.email }}</p>
                        <p><strong>Status:</strong> {{ user.status === 1 ? 'Active' : 'Inactive' }}</p>
                        <p><strong>Role:</strong> {{ user.role }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                     <button id="modalCloseDiv" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
</template>

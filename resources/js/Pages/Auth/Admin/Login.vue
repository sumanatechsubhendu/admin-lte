<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Admin.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
    loginType: 'Admin'
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <div v-if="status" class="mb-4 font-medium text-sm text-red-600">
                    {{ status }}
                </div>
                <form @submit.prevent="submit">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" id="email"
                         v-model="form.email"
                         required autofocus
                         autocomplete="username" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control"
                        placeholder="Password"
                        v-model="form.password"
                        required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <BreezeButton class="ml-1 lowercase" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Log In
                            </BreezeButton>
                            <!-- <button type="submit" class="btn btn-primary btn-block">Sign In</button> -->
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> -->
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Forgot your password?
                    </Link>
                    <!-- <a href="forgot-password.html">I forgot my password</a> -->
                </p>
                <!-- <p class="mb-0">
                    <Link v-if="canResetPassword" :href="route('register')" class="text-center underline text-sm text-gray-600 hover:text-gray-900">
                        Register a new membership
                    </Link>
                </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </BreezeGuestLayout>
</template>


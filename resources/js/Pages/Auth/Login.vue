<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Iniciar sesión" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form class="space-y-6" @submit.prevent="submit">
            <h5 class="text-2xl font-medium text-gray-900 dark:text-white text-center">Iniciar sesión</h5>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail</label>
                <TextInput
                    type="email"
                    name="email"
                    id="email"
                    v-model="form.email"
                    class="mt-1 block w-full"
                    placeholder="nombre@ejemplo.com"
                    required
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                <TextInput
                    type="password"
                    name="password"
                    id="password"
                    v-model="form.password"
                    placeholder="Tu contraseña"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="flex items-start">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" :checked="form.remember" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-background-dark dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
                    </div>
                    <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Recordar sesión</label>
                </div>
                <a :href="route('password.request')" class="ms-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Olvidó la contraseña?</a>
            </div>
            <button :disabled="form.processing" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-dark dark:hover:bg-primary-hover dark:focus:ring-blue-800">Entrar</button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                No está registrado? <a :href="route('register')" class="text-blue-700 hover:underline dark:text-blue-500">Crear Cuenta</a>
            </div>
        </form>

    </GuestLayout>
</template>

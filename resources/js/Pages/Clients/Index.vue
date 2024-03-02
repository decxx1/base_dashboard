<!-- added by victor -->

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CardClient from '@/Components/CardClient.vue';
import CreateClient from '@/Pages/Clients/Partials/CreateClient.vue';
import EditClient from '@/Pages/Clients/Partials/EditClient.vue';
import { Head } from '@inertiajs/vue3';
import ButtonIcon from '@/Components/ButtonIcon.vue';
import Card from '@/Components/Card.vue';
import { ref, onMounted } from 'vue';
import { Drawer } from 'flowbite';

defineProps({
    clients: {
        type: Object,
    },
});

const clientToEdit = ref({});
const drawerEdit = ref(null);
const drawerCreate = ref(null);
const drawerPassword = ref(null);
const drawerEditId = 'client-edit';
const drawerCreateId = 'client-create';
// const drawerPasswordId = 'user-password-change';

const handleDrawerEditToggle = () => {
    drawerEdit.value.toggle();
}
const handleDrawerCreateToggle = () => {
    drawerCreate.value.toggle();
}
const handleDrawerPasswordToggle = () => {
    drawerPassword.value.toggle();
}
const handleOpenDrawerEdit = (client) => {
    clientToEdit.value = client;
    drawerEdit.value.show();
}
// const handleOpenDrawerPassword = (client) => {
//     clientToEdit.value = client;
//     drawerPassword.value.show();
// }
const handleOpenDrawerCreate = () => {
    drawerCreate.value.show();
}

onMounted(() => {
    // set the drawer menu element
    const targetDrawerCreate = document.getElementById(drawerCreateId);
    const targetDrawerEdit = document.getElementById(drawerEditId);
    // const targetDrawerPassword = document.getElementById(drawerPasswordId);

    // options with default values
    const options = {
        placement: 'right',
        backdrop: 'false',
        backdropClasses:
                'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-30',
        bodyScrolling: true,

    };

    drawerEdit.value = new Drawer(targetDrawerEdit, options);
    drawerCreate.value = new Drawer(targetDrawerCreate, options);
    //drawerPassword.value = new Drawer(targetDrawerPassword, options);
})

</script>

<template>
    <Head title="Clientes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Clientes</h2>
        </template>

        <Card >
            <ButtonIcon
                name="Crear Cliente"
                icon="icon-[fa6-solid--user-plus]"
                @click="handleOpenDrawerCreate"
            >
            </ButtonIcon>
        </Card>

        <!-- TO DO : Crear Card client, cambiar CardUser por CardClient. -->
        <Card>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                <CardClient v-for="cliente in clients"
                    :cliente="cliente"
                    :key="cliente.id"
                    :handleOpenDrawerEdit="handleOpenDrawerEdit"
                    :handleOpenDrawerPassword="handleOpenDrawerPassword"
                />
            </div>
        </Card>

        <CreateClient
            :drawerId="drawerCreateId"
            :handleDrawerCreateToggle="handleDrawerCreateToggle"
        />

        <EditClient
            :client="clientToEdit"
            :drawerId="drawerEditId"
            :handleDrawerEditToggle="handleDrawerEditToggle"
        />

        <!-- <ChangePassword
            :user="userToEdit"
            :drawerId="drawerPasswordId"
            :handleDrawerPasswordToggle="handleDrawerPasswordToggle"
        /> -->



    </AuthenticatedLayout>
</template>

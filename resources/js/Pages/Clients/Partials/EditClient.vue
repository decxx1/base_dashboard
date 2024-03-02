<!-- added by victor -->

<script setup>
import DrawerRight from '@/Components/DrawerRight.vue';
import { toast } from 'vue-sonner'
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const props = defineProps ({
    client: {
        type: Object,
        required: true
    },
    handleDrawerEditToggle: {
        type: Function,
        required: true
    },
    drawerId: {
        type: String,
        required: true
    }
})

const form = useForm({
    id: props.client.id,
    name: props.client.name,
    street: props.client.street,
    street_number: props.client.street_number,
    zip_code: props.client.zip_code,
    city: props.client.city,
    state: props.client.state,
    country: props.client.country,
});

watch(() => props.client, () => {
    form.id = props.client.id;
    form.name = props.client.name;
    form.street = props.client.street;
    form.street_number = props.client.street_number;
    form.zip_code = props.client.zip_code;
    form.city = props.client.city;
    form.state = props.client.state;
    form.country = props.client.country;
});

const handleEditClient = () => {
    form.put(route('clients.update', { id: form.id }), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('¡Cliente actualizado!')
            form.reset();
            props.handleDrawerEditToggle();
        },
        onError: (error) => {
            //console.error(error)
            const { name, street, street_number, zip_code, city, state, country } = form.errors;
            if (name) {
                toast.warning(name)
            }else if (street) {
                toast.warning(street)
            }else if (street_number) {
                toast.warning(street_number)
            }else if (zip_code) {
                toast.warning(zip_code)
            }else if (city) {
                toast.warning(city)
            }else if (state){
                toast.warning(state)
            }else if (country){
                toast.warning(country)
            }else if (error.message){
                toast.warning(error.message)
            }
        },
    });
}
</script>

<template>
    <!-- Editar cliente. CAMBIAR EL ICONO DE USER EDIT? -->
    <DrawerRight
        icon="icon-[fa-solid--user-edit]"
        title="Editar Cliente"
        :onSubmit="handleEditClient"
        :drawerId="props.drawerId"
        :handleDrawerToggle="props.handleDrawerEditToggle"
    >
    <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input
                type="text"
                name="name"
                v-model="form.name"
                placeholder="Nombre"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
            </div>
        <div class="mb-6">
            <label for="street" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Calle</label>
            <input
                type="street"
                name="street"
                v-model="form.street"
                placeholder="Calle"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
        <div class="mb-6">
            <label for="street_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Altura</label>
            <input
                type="street_number"
                name="street_number"
                v-model="form.street_number"
                placeholder="Altura"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
        <div class="mb-6">
            <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código Postal</label>
            <input
                type="zip_code"
                name="zip_code"
                v-model="form.zip_code"
                placeholder="Código Postal"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
        <div class="mb-6">
            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ciudad</label>
            <input
                type="city"
                name="city"
                v-model="form.city"
                placeholder="Ciudad"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
        <div class="mb-6">
            <label for="state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provincia</label>
            <input
                type="state"
                name="state"
                v-model="form.state"
                placeholder="Provincia"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
        <div class="mb-6">
            <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País</label>
            <input
                type="country"
                name="country"
                v-model="form.country"
                placeholder="País"
                required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
    </DrawerRight>
</template>

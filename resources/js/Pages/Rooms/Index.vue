<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const { rooms } = usePage().props;

const form = useForm({
    name: '',
    floor: null,
    size: '',
    window_direction: ''
});

const submit = () => {
    form.post('/rooms', {
        onSuccess: () => {
            console.log("Room added successfully");
        },
        onError: () => {
            console.log("An error occurred");
        }
    });
};
</script>

<template>
    <Head title="Patalpos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Patalpos</h2>
        </template>

        <div class="pt-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">Visos Patalpos</div>
                </div>
            </div>
        </div>

        <div class="pt-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <InputLabel for="name" value="Pavadinimas" />
                                <TextInput id="name" v-model="form.name" type="text" placeholder="Pavadinimas" class="mt-1 block w-full" />
                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="floor" value="Aukštas" />
                                <TextInput id="floor" v-model="form.floor" type="number" placeholder="Aukštas" class="mt-1 block w-full" />
                                <InputError :message="form.errors.floor" class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="size" value="Dydis, m²" />
                                <TextInput id="size" v-model="form.size" type="text" placeholder="Dydis, m²" class="mt-1 block w-full" />
                                <InputError :message="form.errors.size" class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="window_direction" value="Langų Pusė" />
                                <TextInput id="window_direction" v-model="form.window_direction" type="text" placeholder="Langų Pusė" class="mt-1 block w-full" />
                                <InputError :message="form.errors.window_direction" class="mt-2" />
                            </div>
                            <button type="submit" class="col-span-4 bg-indigo-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Pridėti
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto">
                        <table class="min-w-full leading-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-500 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                    Pavadinimas
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-500 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                    Aukštas
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-500 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                    Dydis m²
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-500 bg-gray-200 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                    Langų Pusė
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="room in rooms.data" :key="room.id">
                                    <td class="px-5 py-5 border-b border-gray-500 bg-white dark:bg-gray-800 text-sm">
                                        <div class="flex items-center">
                                            <div class="ml-3">
                                                <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                                    {{ room.name }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-500 bg-white dark:bg-gray-800 text-sm">
                                        <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ room.floor }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-500 bg-white dark:bg-gray-800 text-sm">
                                        <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ room.size }} m²</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-500 bg-white dark:bg-gray-800 text-sm">
                                        <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                            {{ room.window_direction || 'N/A' }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
// import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head , Link } from '@inertiajs/inertia-vue3';
import Employee from './Employee';
import Dashboard from './Dashboard';
// const props =defineProps({props:Array });
// props = {{ $page['props'] }};
console.log(props);
</script>

<template>
    <Head title="Product" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product
            </h2>
        </template>

      


        </BreezeAuthenticatedLayout>

</template>
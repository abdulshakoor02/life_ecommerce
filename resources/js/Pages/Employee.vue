<script setup>
// import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head , Link} from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
const props =defineProps({employee : Array});
console.log(props)
</script>

<template>
    <Head title="Employee" />


    <BreezeAuthenticatedLayout>
    
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Employee
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-end mt-4">
                        <Link href="/create" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">add employee</Link>
                        </div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">Mobile</th>
      <th scope="col">Address</th>
      <th scope="col">Designation</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="emp in employee" :key="emp.id">
      <td scope="row">{{ emp.id }}</td>
      <td>{{ emp.name }}</td>
      <td>{{ emp.mobile }}</td>
      <td>{{ emp.address }}</td>
      <td>{{ emp.designation }}</td>
      <td><Link :href="`/edit/${emp.id}`" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">Edit</Link>
</td>
      <td>delete</td>
    </tr>
  </tbody>
</table>                    </div>
                </div>
            </div>
        </div>
        
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head , Link} from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {Inertia} from '@inertiajs/inertia';

const props =defineProps({orders : Array ,orderid:['orderid']});
console.log(props)

// const search = () => {
//     Inertia.post(`/search_order`,{
//         _method:'post',
//         id:props.orderid
//     });
// }
</script>

<template>
    <Head title="Order" />


    <BreezeAuthenticatedLayout>
    
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Order
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-end mt-4">
                        </div>

                        
      <!-- <div>
                <BreezeLabel for="search" value="Search order by id" />
                <BreezeInput id="search" v-on:keyup="search" type="text" class="mt-1 block w-full" style="width:20%" v-model="orderid"   required />

            </div> -->

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Products</th>
      <th scope="col">Total</th>
      <th scope="col">Status</th>
      <th scope="col">Order date</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="or in orders" :key="or.id">
      <td>{{or.products}}</td>
      <td>{{or.total}}</td>
      <td>{{or.status}}</td>
      <td>{{or.created_at}}</td>
    </tr>
  </tbody>
</table>         
<br/>    

     </div>
                </div>
            </div>
        </div>
        
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head , Link} from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {Inertia} from '@inertiajs/inertia';

const props =defineProps({transactions : Array});
console.log(props)

const update = (v,id) => {
    Inertia.post(`/update_trans`,{
        _method:'post',
        status:v,
        id:id
    });
}
</script>

<template>
    <Head title="Transactions" />


    <BreezeAuthenticatedLayout>
    
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transactions
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-end mt-4">
                        </div>
                        <div>
                        ** Transactions will be automated approve and reject will be set by response from payment gateway below is to immitate that
                        </div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Transaction id</th>
      <th scope="col">order id</th>
      <th scope="col">status</th>
      <th scope="col">Update</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="trn in transactions" :key="trn.id">
      <td>{{trn.id}}</td>
      <td>{{trn.orderid}}</td>
      <td>{{trn.status}}</td>
      <td>
      
<Button class="ml-4" v-on:click="update(1,trn.id)"  >
                    Approve
                </Button> / 
<Button class="ml-4" v-on:click="update(3,trn.id)"  >
                    Reject
                </Button>
</td>
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

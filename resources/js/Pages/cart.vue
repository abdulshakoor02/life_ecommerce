<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head , Link} from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
const props =defineProps({cart : Array});
console.log(props)

const order = () => {
    console.log(props.cart);
}
</script>

<template>
    <Head title="Cart" />


    <BreezeAuthenticatedLayout>
    
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cart
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-end mt-4">
                        </div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Product</th>
      <th scope="col">quantity</th>
      <th scope="col">price</th>
      <th scope="col">total</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="crt in cart" :key="crt.id">
      <td>{{crt.productname}}</td>
      <td>{{crt.quantity}}</td>
      <td>{{crt.price}}</td>
      <td>{{crt.totcharge}}</td>
      <td><Link :href="`/delete_cart/${crt.id}`" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">delete</Link>
</td>
    </tr>
  </tbody>
</table>         
<br/>    

<Button class="ml-4" v-on:click="order"  >
                    Place order
                </Button>

     </div>
                </div>
            </div>
        </div>
        
    </BreezeAuthenticatedLayout>
</template>

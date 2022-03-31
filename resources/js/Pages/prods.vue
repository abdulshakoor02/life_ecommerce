<script setup>
    // import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head , Link, useForm} from '@inertiajs/inertia-vue3';
    import BreezeButton from '@/Components/Button.vue';
    import BreezeGuestLayout from '@/Layouts/Guest.vue';
    import BreezeInput from '@/Components/Input.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
    import {Inertia} from '@inertiajs/inertia';
    import Swal from 'sweetalert2';

    const data = defineProps ({prodid:Object,price:Object,prodname:Object,prodesc:Object});
    // console.log(data);

            const form =useForm({
                    quantity:'',
                    price:data.price,
                    id:data.prodid,
                  });


const submit = ()=>{
  // console.log(form);
  Swal.fire(form.quantity+' of '+data.prodname+' add to cart');
  form.post('/cart_add');
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

<div class="group relative">
        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
          <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg" alt="Front of men&#039;s Basic Tee in black." class="w-full h-full object-center object-cover lg:w-full lg:h-full">
        </div>
        <div class="mt-4 flex justify-between">
          <div>
            <h3 class="text-sm text-gray-700">
              <!-- <a :href="prod.test"> -->
                <span aria-hidden="true" class="absolute inset-0"></span>
                {{prodname}}
              <!-- </a> -->
            </h3>
            <p class="mt-1 text-sm text-gray-500">{{desc}}</p>
          </div>
          <p class="text-sm font-medium text-gray-900">AED{{price}}</p>
        </div>
            
      </div>
                <form @submit.prevent="submit">

      <div>
                <BreezeLabel for="'quantity" value="quantity" />
                <BreezeInput id="quantity"  type="text" class="mt-1 block w-full" style="width:20%" v-model="form.quantity"   required />
            </div>
<br/>
            
                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    add to cart
                </BreezeButton>

                </form>


      </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import {Inertia} from '@inertiajs/inertia';

const form = useForm({
    name: props.employee.name,
    mobile: props.employee.mobile,
    address: props.employee.address,
    designation: props.employee.designation,
});

const submit = () => {
    // console.log(`/update/${props.employee.id}`);
    Inertia.post(`/update/${props.employee.id}`,{
        _method:'put',
        name:form.name,
        mobile:form.mobile,
        address:form.address,
        designation:form.designation
    });
};

const props = defineProps({employee:Object})
console.log(props)
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Edit" />


        <BreezeValidationErrors class="mb-4" />

        
        <div class="flex items-center justify-end mt-4">
                        <Link href="/" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">Back</Link>
                        </div>

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="name" value="Name" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div>
                <BreezeLabel for="mobile" value="mobile" />
                <BreezeInput id="mobile" type="text" class="mt-1 block w-full" v-model="form.mobile" required autofocus autocomplete="name" />
            </div>

            <div>
                <BreezeLabel for="address" value="address" />
                <BreezeInput id="address" type="text" class="mt-1 block w-full" v-model="form.address" required autofocus autocomplete="name" />
            </div>


            <div>
                <BreezeLabel for="designation" value="designation" />
                <BreezeInput id="designation" type="text" class="mt-1 block w-full" v-model="form.designation" required autofocus autocomplete="name" />
            </div>


            <div class="flex items-center justify-end mt-4">

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Update
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>

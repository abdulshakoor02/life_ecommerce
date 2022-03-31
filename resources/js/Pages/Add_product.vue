<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import {Inertia} from '@inertiajs/inertia';


const form = useForm({
    name: '',
    desc:'',
    price:'',
    image: '',
});

const submit = () => {
    // console.log(form)
    form.post('/store');
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Create" />


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
                <BreezeLabel for="desc" value="desc" />
                <BreezeInput id="desc" type="text" class="mt-1 block w-full" v-model="form.desc" required autofocus autocomplete="name" />
            </div>

            <div>
                <BreezeLabel for="price" value="price" />
                <BreezeInput id="price" type="text" class="mt-1 block w-full" v-model="form.price" required autofocus autocomplete="name" />
            </div>

            <div>
                <BreezeLabel for="image" value="image" />
                <BreezeInput id="image" type="file" class="mt-1 block w-full" @input="form.image = $event.target.files[0]" required autofocus />
            </div>


            <div class="flex items-center justify-end mt-4">

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Add
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>

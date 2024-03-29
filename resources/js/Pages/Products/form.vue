<script setup>
import { computed } from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    product: {
        type: Object,
        default: null
    },
    parentCategories: {
        type: Object
    }
});
const isEditing = computed(() => !!props.product);

const form = useForm({
    name: props.product ? props.product.name : '',
    price: props.product ? props.product.price : '',
    status: props.product ? props.product.status : false,
});

const submit = () => {
    if (props.product && props.product.id) {
        form.post(route('product-update', props.product.id));
        return;
    }
    form.post(route('product-store'));
}
</script>

<template>

    <Head :title="isEditing ? 'Edit Product' : 'Create Product'" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ isEditing ? 'Edit' : 'Add' }} Product
            </h2>
            <div class="mt-5">
                <form class="max-w-sm" @submit.prevent="submit">
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Product Name</label>
                        <input type="text" id="name" name="name" v-model="form.name"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                        <div v-if="form.errors.name" class="text-red-600">{{ form.errors.name }}</div>
                    </div>
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Select categories</label>
                        <select v-model="selectedCategory" @change="getChildCategories"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-white-600 dark:placeholder-white-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Category</option>
                            <option :value="parentCategory.id" v-for="parentCategory in parentCategories">
                                {{ parentCategory.name }}
                            </option>
                            {{ parentCategories }}
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Price</label>
                        <input type="text" id="price" name="price" v-model="form.price"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                        <div v-if="form.errors.price" class="text-red-600">{{ form.errors.price }}</div>
                    </div>
                    <div class="mb-5 mt-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Status</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" value="1" class="sr-only peer" name="status" v-model="form.status"
                                :checked="form.status">
                            <div
                                class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                        </label>
                        <div v-if="form.errors.status" class="text-red-600">{{ form.errors.status }}</div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            {{ isEditing ? 'Update' : 'Save' }}
                        </button>
                        <Link :href="route('products-list')"
                            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Cancel</Link>
                    </div>
                </form>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
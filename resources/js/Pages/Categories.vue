<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {defineProps, ref} from 'vue';
import axios from 'axios';


import CategoryData = App.Data.CategoryData;

const props = defineProps<{
  categories: CategoryData[];
}>();

const categories = ref(props.categories);

const searchQuery = ref('');
const search = async () => {
  const response = await axios.get(`/search-categories?category-name=${searchQuery.value}`);
  categories.value = response.data;
};


const categoryIds = ref([]);
const deleteCategories = async () => {
  await axios.post('/delete-categories', {ids: categoryIds.value});
};
</script>

<template>
  <Head title="Categories"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Assets</h2>
    </template>

    <div class="overflow-x-auto">
      <div class="flex justify-start py-4 flex flex-row">
        <div class="form-control w-96 mx-4">
          <input type="text" placeholder="Search" class="input input-bordered" v-model="searchQuery" @input="search"/>
        </div>
        <div class="form-control w-42 mx-4 ">
          <button class="btn btn-outline btn-accent" @click="deleteCategories">Delete</button>
        </div>
      </div>


      <table class="table mx-4 mt-2">
        <!-- head -->
        <thead>
        <tr>
          <th>
          </th>
          <th>ID</th>
          <th>Name</th>
        </tr>
        </thead>
        <tbody>
        <!-- row 1 -->
        <tr v-for="category in categories" class="hover">
          <th>
            <label>
              <input type="checkbox" class="checkbox" v-model="categoryIds" :value="category.id"/>
            </label>
          </th>
          <td>
            {{ category.id }}
          </td>
          <td>
            <div class="font-bold">{{ category.name }}</div>
          </td>
        </tr>
        </tbody>
        <!-- foot -->
        <tfoot>
        <tr>
          <th></th>
          <th>ID</th>
          <th>Name</th>
        </tr>
        </tfoot>

      </table>
    </div>

  </AuthenticatedLayout>
</template>

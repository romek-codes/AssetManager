<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { FlexRender } from '@tanstack/vue-table'
import { useVueTable } from '@tanstack/vue-table'
// const table = useVueTable()
import { defineProps, ref } from 'vue';


import AssetData = App.Data.AssetData;
import CategoryData = App.Data.CategoryData;
import AssignedUserData = App.Data.AssignedUserData;

const props = defineProps<{
  categories: CategoryData[];
}>();

const assets = ref(props.assets);

</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Assets</h2>
        </template>

<!--      <tbody>-->
<!--      <tr v-for="row in table.getRowModel().rows" :key="row.id">-->
<!--        <td v-for="cell in row.getVisibleCells()" :key="cell.id">-->
<!--          <FlexRender-->
<!--              :render="cell.column.columnDef.cell"-->
<!--              :props="cell.getContext()"-->
<!--          />-->
<!--        </td>-->
<!--      </tr>-->
<!--      </tbody>-->

      <div class="overflow-x-auto">
          <div class="flex justify-start py-4">
            <div class="mx-4">
              <div class="form-control w-96">
                <input type="text" placeholder="Search" class="input input-bordered" />
              </div>
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
                <input type="checkbox" class="checkbox" />
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

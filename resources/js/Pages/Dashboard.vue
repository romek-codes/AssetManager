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
  assets: AssetData[];
  categories: CategoryData[];
  assignableUsers: AssignedUserData[];
}>();

const assets = ref(props.assets);

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
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
        <table class="table mx-12 mt-2">
          <!-- head -->
          <thead>
          <tr>
            <th></th>
            <th></th>
            <th>
              <select class="select select-primary w-full max-w-xs">
                <option disabled selected>Filter by Name</option>
                <option v-for="asset in assets"> {{ asset.name }} </option>
              </select>
            </th>
            <th>
              <select class="select select-primary w-full max-w-xs">
                <option disabled selected>Filter by Category</option>
                <option v-for="category in categories"> {{ category.name }} </option>
              </select>
            </th>
            <th>
              <select class="select select-primary w-full max-w-xs">
                <option disabled selected>Filter by Assigned User</option>
                <option v-for="assignableUser in assignableUsers"> {{ assignableUser.firstName + " " + assignableUser.lastName }} </option>
              </select>
            </th>
          </tr>
          <tr>
            <th>
            </th>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Assigned User</th>
          </tr>
          </thead>
          <tbody>
          <!-- row 1 -->
          <tr v-for="asset in assets">
            <th>
              <label>
                <input type="checkbox" class="checkbox" />
              </label>
            </th>
            <td>
              {{ asset.id }}
            </td>
            <td>
              <div class="flex items-center space-x-3">
                <div class="avatar">
                  <div class="mask mask-squircle w-12 h-12">
                    <img v-if="asset.image" :src="asset.image?.url"  :alt="asset.name + ' image'" />
                    <img v-else src="https://www.svgrepo.com/show/451667/image-missing.svg"  :alt="asset.name + ' image'" />
                  </div>
                </div>
                <div>
                  <div class="font-bold">{{ asset.name }}</div>
                </div>
              </div>
            </td>
            <td>
              {{ asset.category?.name }}
            </td>
            <td v-if="asset.assignedUser">{{ asset.assignedUser?.firstName }} {{ asset.assignedUser?.lastName }}</td>
            <td v-else> Not Assigned </td>
          </tr>
          </tbody>
          <!-- foot -->
          <tfoot>
          <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Assigned User</th>
          </tr>
          </tfoot>

        </table>
      </div>

    </AuthenticatedLayout>
</template>

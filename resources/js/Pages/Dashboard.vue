<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { FlexRender } from '@tanstack/vue-table'
import { useVueTable } from '@tanstack/vue-table'
// const table = useVueTable()


import AssetData = App.Data.AssetData;
import { defineProps, ref } from 'vue';

const props = defineProps<{
  assets: AssetData[];
}>();

const assets = ref(props.assets);

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

      <li v-for="asset in assets">
        {{ asset.id }}
        {{ asset.image }}
        {{ asset.name }}
        {{ asset.category.name }}
        {{ asset.assignedUser?.firstName + asset.assignedUser?.lastName }}
      </li>

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
    </AuthenticatedLayout>
</template>

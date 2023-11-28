<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {FlexRender} from '@tanstack/vue-table'
import {useVueTable} from '@tanstack/vue-table'
// const table = useVueTable()
import {defineProps, ref} from 'vue';


import AssetData = App.Data.AssetData;
import CategoryData = App.Data.CategoryData;
import AssignedUserData = App.Data.AssignedUserData;
import axios from 'axios';

const searchQuery = ref('');
const search = async () => {
  const response = await axios.get(`/search-assets?asset-name=${searchQuery.value}`);
  assets.value = response.data;
};

const props = defineProps<{
  assets: AssetData[];
  categories: CategoryData[];
  assignableUsers: AssignedUserData[];
}>();

const assets = ref(props.assets);
// for (let asset of assets.value) {
//   for (let assetComponent of asset.assetComponents) {
//     console.log(assetComponent);
//   }
// }

</script>

<template>
  <Head title="Assets"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Assets</h2>
    </template>
    <dialog id="editModal" class="modal">
      <div class="modal-box">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <div class="form-control w-96">
          <input type="text" placeholder="" class="input input-bordered"/>
        </div>
      </div>
      <form method="dialog" class="modal-backdrop">
        <button>close</button>
      </form>
    </dialog>

    <div class="overflow-x-auto">
      <div class="flex justify-start py-4">
        <div class="px-4">
          <div class="form-control w-96">
            <input type="text" placeholder="Search" class="input input-bordered" v-model="searchQuery" @input="search"/>
          </div>
        </div>
        <div></div>
        <div class="px-4">
          <select class="select select-primary w-full max-w-xs">
            <option disabled selected>Filter by Name</option>
            <option v-for="asset in assets"> {{ asset.name }}</option>
          </select>
        </div>
        <div class="px-4">
          <select class="select select-primary w-full max-w-xs">
            <option disabled selected>Filter by Category</option>
            <option v-for="category in categories"> {{ category.name }}</option>
          </select>
        </div>
        <div class="px-4">
          <select class="select select-primary w-full max-w-xs">
            <option disabled selected>Filter by Assigned User</option>
            <option v-for="assignableUser in assignableUsers">
              {{ assignableUser.firstName + " " + assignableUser.lastName }}
            </option>
          </select>
        </div>
      </div>
      <section class="flex flex-col mt-2">
        <!-- head -->
        <header>
          <article class="flex flex-row justify-around mb-8 justify-center items-center">
            <label>
              <input type="checkbox" class="checkbox"/>
            </label>
<!--            <p>ID</p>-->
            <p>Name</p>
            <p>Category</p>
            <p>Assigned User</p>
          </article>
        </header>
        <!-- body -->
        <main class="flex flex-col bg-primary">
          <template v-for="(asset, index) in assets">
            <article class="flex flex-row items-center justify-around h-14" :class="{'bg-accent': index % 2 === 0}">
              <label>
                <input type="checkbox" class="checkbox"/>
              </label>
<!--              <p class="w-32">{{asset.id}}</p>-->
              <div class="flex items-center space-x-3 w-32">
                <div class="avatar">
                  <div class="mask mask-squircle w-12 h-12">
                    <img v-if="asset.image" :src="asset.image?.url" :alt="asset.name + ' image'"/>
                    <img v-else src="https://www.svgrepo.com/show/451667/image-missing.svg" :alt="asset.name + ' image'"/>
                  </div>
                </div>
                <div>
                  <div class="font-bold">{{ asset.name }}</div>
                </div>
              </div>
              <p class="w-32">{{ asset.category?.name }}</p>
              <p class="w-32" v-if="asset.assignedUser">{{ asset.assignedUser?.firstName }} {{ asset.assignedUser?.lastName }}</p>
              <p class="w-32" v-else > Not Assigned</p>
            </article>
            <article class="flex flex-col mb-8" :class="{'bg-accent': index % 2 === 0}">
              <article class="w-1/3" >

              </article>
            <article class="pl-10 flex flex-row items-center justify-around h-14 bg-secondary w-2/3 self-end" v-for="assetComponent in asset.assetComponents">
<!--                <label class="w-32">-->
<!--                  <input type="checkbox" class="checkbox"/>-->
<!--                </label>-->
                <div class="flex items-center space-x-3 w-32">
                  <div class="avatar">
                    <div class="mask mask-squircle w-12 h-12">
                      <img v-if="assetComponent.image" :src="assetComponent.image?.url" :alt="assetComponent.name + ' image'"/>
                      <img v-else src="https://www.svgrepo.com/show/451667/image-missing.svg" :alt="assetComponent.name + ' image'"/>
                    </div>
                  </div>
                  <div>
                    <div class="font-bold">{{ asset.name }}</div>
                  </div>
                </div>
                <p class="w-32">{{ assetComponent.category?.name }}</p>
                <p class="w-32" v-if="assetComponent.assignedUser">{{ assetComponent.assignedUser?.firstName }} {{ assetComponent.assignedUser?.lastName }}</p>
                <p class="w-32" v-else> Not Assigned</p>
            </article>
            </article>
          </template>
        </main>
      </section>
    </div>

    <!--    Bottom bar-->
    <div class="sticky bottom-1 flex flex-row justify-center">

      <div class="px-4">
        <button class="btn btn-primary " onclick="editModal.showModal()">
          Add
        </button>
      </div>
      <div class="px-4">
        <button class="btn btn-primary " onclick="editModal.showModal()">
          Edit
        </button>
      </div>
      <div class="px-4">
        <button class="btn btn-primary ">
          Delete
        </button>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

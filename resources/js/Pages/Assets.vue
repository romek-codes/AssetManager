<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import AssetComponentModal from "@/Components/AssetComponentModal.vue";
import {defineProps, reactive, ref} from 'vue';
import AssetData = App.Data.AssetData;
import CategoryData = App.Data.CategoryData;
import AssignedUserData = App.Data.AssignedUserData;
import axios from 'axios';
import AssetComponentData = App.Data.AssetComponentData;

const searchQuery = ref('');
const search = async () => {
  const response = await axios.get(`/search-assets?asset-name=${searchQuery.value}`);
  assets.value = response.data;
};

const showDetailsModalData = reactive({});

function showDetails(assetComponents: AssetComponentData[], show: boolean) {
  this.showDetailsModalData = assetComponents;
}

const props = defineProps<{
  assets: AssetData[];
  categories: CategoryData[];
  assignableUsers: AssignedUserData[];
}>();

const assets = ref(props.assets);

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
          <article class="flex flex-row justify-around pb-8 items-center">
            <label class="invisible">
              <input type="checkbox" class="checkbox"/>
            </label>
            <p>ID</p>
            <p class="w-32">Name</p>
            <p class="w-32">Category</p>
            <p class="w-32">Assigned User</p>
            <p class="w-32">Details</p>
          </article>
        </header>
        <!-- body -->
        <main class="flex flex-col bg-base-100">
          <AssetComponentModal :asset-components="showDetailsModalData"></AssetComponentModal>
          <template v-for="(asset, index) in assets">
            <div class="divider h-0 m-0"></div>
            <article class="flex flex-row items-center justify-around pt-8 pb-2"
                     :class="{'bg-base-200': index % 2 === 0}">
              <label>
                <input type="checkbox" class="checkbox checkbox-xs"/>
              </label>
              <p class="w-32">{{ asset.id }}</p>
              <div class="flex items-center space-x-3 w-32">
                <div class="avatar">
                  <div class="mask mask-squircle w-12 h-12">
                    <img v-if="asset.image" :src="asset.image?.url" :alt="asset.name + ' image'"/>
                    <img v-else src="https://www.svgrepo.com/show/451667/image-missing.svg"
                         :alt="asset.name + ' image'"/>
                  </div>
                </div>
                <div>
                  <div class="font-bold">{{ asset.name }}</div>
                  <div class="text-xs text-secondary">Name</div>
                </div>
              </div>
              <div>
                <p class="w-32">{{ asset.category?.name }}</p>
                <div class="text-xs text-secondary">Category</div>
              </div>
              <div>
                <p class="w-32" v-if="asset.assignedUser">{{ asset.assignedUser?.firstName }}
                  {{ asset.assignedUser?.lastName }}</p>
                <p class="w-32" v-else> Not Assigned</p>
                <div class="text-xs text-secondary">Assigned User</div>
              </div>
              <div>
                <button v-if="asset.assetComponents" class="btn btn-primary "
                        @click="showDetails(asset.assetComponents, true)">
                  <!--                        onclick="showDetails.showModal()">-->
                  View Details
                </button>
                <!--                <div class="text-xs text-secondary">Assigned User</div>-->
              </div>
            </article>
            <article class="flex flex-row pb-8" :class="{'bg-base-200': index % 2 === 0}">
              <div class="w-1/12 justify-center">
              </div>
              <div class="flex flex-col w-11/12 self-end">
              </div>
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

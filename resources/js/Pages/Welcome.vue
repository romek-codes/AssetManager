<script setup lang="ts">
import {onMounted, ShallowRef, shallowRef} from 'vue';
import {Head, Link} from '@inertiajs/vue3';
import {TresCanvas, useRenderLoop} from "@tresjs/core";
import {GLTFModel, OrbitControls} from '@tresjs/cientos'
// import {TWEEN} from '@tweenjs/tween.js';
import * as THREE from 'three';
import {watch} from 'vue';

const switchModel: ShallowRef<TresInstance | null> = shallowRef(null)
const computerModel: ShallowRef<TresInstance | null> = shallowRef(null)
const laptopModel: ShallowRef<TresInstance | null> = shallowRef(null)
const camera: ShallowRef<TresInstance | null> = shallowRef(null)
const {onLoop} = useRenderLoop()
let allModelsLoaded = false;

defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
  laravelVersion: string;
  phpVersion: string;
}>();

onLoop(({delta, elapsed}) => {
  if (allModelsLoaded) {
    switchModel.value.value.position.y += 0.01
    computerModel.value.value.position.y += 0.01
    laptopModel.value.value.position.y += 0.01
  }
});

watch([switchModel, laptopModel, computerModel], () => {
  if (switchModel.value && laptopModel.value && computerModel.value) {
    allModelsLoaded = true;
    // switchModel.value.value.position.set(-7, -0, 5);
    // computerModel.value.value.position.set(-1, 0, 0);
    // laptopModel.value.value.position.set(4, 0, 5);
    // console.log('???????');
  }
});

let pathToImage = "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.wallpaperup.com%2Fuploads%2Fwallpapers%2F2012%2F08%2F04%2F8076%2F2e659af0b4d60cdc7ec39f7332a20389.jpg&f=1&nofb=1&ipt=c509815c3836e72ae5d4b265adf5d449b83cdb3601735c84cae0996d41e6e952&ipo=images";


import {computed} from 'vue'
import {usePage} from '@inertiajs/vue3'

const page = usePage()

const appName = computed(() => page.props.appName)

</script>

<template>
  <Head title="Asset Management"/>
  <!--  Computer by Poly by Google [CC-BY] via Poly Pizza-->
  <!--  Laptop by Poly by Google [CC-BY] via Poly Pizza-->
  <TresCanvas alpha="alpha" window-size>
    <TresPerspectiveCamera :position="[15, 15, 15]" ref="camera"/>
    <Suspense>
      <GLTFModel :position="[-7, -10, 5]" :rotation="[0, 10, 0]" ref="switchModel" path="/3d/switch/switch.glb"
                 draco/>
    </Suspense>
    <Suspense>
      <GLTFModel :position="[-1, -10, 0]" :scale="[0.01, 0.01, 0.01]" ref="computerModel"
                 path="/3d/computer/Computer.glb"
                 draco/>
    </Suspense>
    <OrbitControls></OrbitControls>
    <Suspense>
      <GLTFModel :position="[4, -10, 5]" :rotation="[0, -4, 0]" :scale="[0.003, 0.003, 0.003]" ref="laptopModel"
                 path="/3d/laptop/Laptop.glb"
                 draco/>
    </Suspense>
    <TresAmbientLight :intensity="4"/>
  </TresCanvas>

  <div id="landing" class="flex flex-col">

    <div class="navbar z-10">
      <div class="flex-1">
        <a class="btn btn-ghost normal-case text-xl">{{ appName }}</a>
      </div>
      <div v-if="canLogin" class="justify-end p-6 text-right bg-base">
        <Link
            v-if="$page.props.auth.user"
            :href="route('dashboard')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
        >Dashboard
        </Link
        >

        <template v-else>
          <Link
              :href="route('login')"
              class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
          >Log in
          </Link
          >

          <Link
              v-if="canRegister"
              :href="route('register')"
              class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
          >Register
          </Link
          >
        </template>
      </div>
      <!--    If user auth -->
      <!--    <div class="flex-none gap-2">-->
      <!--      <div class="form-control">-->
      <!--        <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto"/>-->
      <!--      </div>-->
      <!--      <div class="dropdown dropdown-end">-->
      <!--        <label tabindex="0" class="btn btn-ghost btn-circle avatar">-->
      <!--          <div class="w-10 rounded-full">-->
      <!--            <img :src="pathToImage"/>-->
      <!--          </div>-->
      <!--        </label>-->
      <!--        <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">-->
      <!--          <li>-->
      <!--            <a class="justify-between">-->
      <!--              Profile-->
      <!--              <span class="badge">New</span>-->
      <!--            </a>-->
      <!--          </li>-->
      <!--          <li><a>Settings</a></li>-->
      <!--          <li><a>Logout</a></li>-->
      <!--        </ul>-->
      <!--      </div>-->
      <!--    </div>-->
    </div>
    <h1 class="self-center text-xl">
      Asset Management Done Right
    </h1>
  </div>
</template>

<style>
.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}
</style>

<script setup lang="ts">
import {ShallowRef, shallowRef} from 'vue';
import {Head, Link} from '@inertiajs/vue3';
import {TresCanvas, useRenderLoop} from "@tresjs/core";
import {GLTFModel} from '@tresjs/cientos'
import {ref} from "vue";
import * as THREE from 'three';

const retroPc: ShallowRef<TresInstance | null> = shallowRef(null)
const {onLoop} = useRenderLoop()

defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
  laravelVersion: string;
  phpVersion: string;
}>();

document.addEventListener('mousemove', onDocumentMouseMove);


const target = new THREE.Vector3();
let mouseX = 0, mouseY = 0;
const windowHalfX = window.innerWidth / 2;
const windowHalfY = window.innerHeight / 2;

function onDocumentMouseMove(event) {
  mouseX = (event.clientX - windowHalfX);
  mouseY = (event.clientY - windowHalfY);
  if (mouseX > 80) {
    target.x = 80
  } else if (mouseX < 20) {
    target.x = 20
  } else {
    target.x = mouseX; // Update the x position of the target
  }
  if (mouseY < -50) {
    target.y = 50
  } else if (mouseY > -10) {
    target.y = 10
  } else {
    target.y = -mouseY; // Update the x position of the target
  }
  console.log('X');
  console.log(target.x)
  console.log('Y');
  console.log(target.y)
}

onLoop(({delta, elapsed}) => {
  if (retroPc.value) {
    mouseX += (mouseX - target.x) * 0.02;
    mouseY += (mouseY - target.y) * 0.02;
    target.z = 40

    retroPc.value.value.lookAt(target);

    // retroPc.value.value.rotation.y += delta * 0.5;
    // retroPc.value.value.rotation.z = elapsed * 0.2;
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

  <div id="landing" class="flex flex-col">

    <div class="navbar">
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

  <TresCanvas alpha="alpha" window-size>
    <TresPerspectiveCamera :position="[1, 1, 1]" :look-at="[0, -0.2, 0]"/>
    <Suspense>
      <GLTFModel ref="retroPc" path="/3d/retro_computer/scene-transformed.gltf" draco/>
    </Suspense>
    <TresAmbientLight :intensity="4"/>
  </TresCanvas>
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

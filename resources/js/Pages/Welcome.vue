<script setup lang="ts">
import {ShallowRef, shallowRef} from 'vue';
import {Head, Link} from '@inertiajs/vue3';
import {TresCanvas, useRenderLoop} from "@tresjs/core";
import {GLTFModel} from '@tresjs/cientos'
import {OrbitControls} from '@tresjs/cientos';

const retroPc: ShallowRef<TresInstance | null> = shallowRef(null)
const {onLoop} = useRenderLoop()

defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
  laravelVersion: string;
  phpVersion: string;
}>();

onLoop(({delta, elapsed}) => {
  if (retroPc.value) {
    retroPc.value.value.rotation.y += delta
    // retroPc.value.value.rotation.z = elapsed * 0.2
  }
})
</script>

<template>
  <Head title="Asset Management"/>

  <TresCanvas clear-color="#fff" window-size>
    <TresPerspectiveCamera :position="[1, 1, 1]" :look-at="[0, -0.2, 0]"/>
    <Suspense>
      <GLTFModel ref="retroPc" path="/3d/retro_computer/scene-transformed.gltf" draco/>
    </Suspense>
    <TresAmbientLight :intensity="4"/>
  </TresCanvas>

  <div class="z-10 absolute w-full flex flex-col">
    <div v-if="canLogin" class="justify-end p-6 text-right">
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

    <h1 class="self-center text-xl pt-">
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

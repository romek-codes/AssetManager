<script setup lang="ts">
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>

  <div class="navbar bg-base-100">
    <div class="flex-1">
      <Link :href="route('assets')" class="btn btn-ghost normal-case text-xl mr-2">
          <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"/>
          AssetManagement
      </Link>
      <NavLink :href="route('assets')" :active="route().current('assets')">
          Assets
      </NavLink>
      <NavLink :href="route('categories')" :active="route().current('categories')">
          Categories
      </NavLink>
    </div>
    <div class="flex-none gap-2">
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <!-- TODO REPLACE WITH DYNAMIC URL -->
            <img src="https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Ffunpeep.com%2Fwp-content%2Fuploads%2F2015%2F11%2FCute-Pictures-of-Dogs-Pomeranian-Puppy.jpg&f=1&nofb=1&ipt=3c750e29ac28cd4b6f222e60f1defb0e0a505dddcf8515adf9b74e3d54e05aff&ipo=images" />
          </div>
        </label>
        <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
          <ResponsiveNavLink :href="route('profile.edit')" :active="route().current('profile.edit')">
            Profile
          </ResponsiveNavLink>
          <ResponsiveNavLink :href="route('logout')" method="post" as="button">
            Logout
          </ResponsiveNavLink>
        </ul>
      </div>
    </div>
  </div>
  <main>
      <slot />
  </main>


<!--    <div>-->
<!--        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">-->
<!--            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">-->
<!--                &lt;!&ndash; Primary Navigation Menu &ndash;&gt;-->
<!--                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">-->
<!--                    <div class="flex justify-between h-16">-->
<!--                        <div class="flex">-->
<!--                            &lt;!&ndash; Logo &ndash;&gt;-->
<!--                            <div class="shrink-0 flex items-center">-->
<!--                                <Link :href="route('assets')">-->
<!--                                    <ApplicationLogo-->
<!--                                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"-->
<!--                                    />-->
<!--                                </Link>-->
<!--                            </div>-->

<!--                            &lt;!&ndash; Navigation Links &ndash;&gt;-->
<!--                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">-->
<!--                                <NavLink :href="route('assets')" :active="route().current('assets')">-->
<!--                                    Assets-->
<!--                                </NavLink>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="hidden sm:flex sm:items-center sm:ml-6">-->
<!--                            &lt;!&ndash; Settings Dropdown &ndash;&gt;-->
<!--                            <div class="ml-3 relative">-->
<!--                                <Dropdown align="right" width="48">-->
<!--                                    <template #trigger>-->
<!--                                        <span class="inline-flex rounded-md">-->
<!--                                            <button-->
<!--                                                type="button"-->
<!--                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"-->
<!--                                            >-->
<!--                                                {{ $page.props.auth.user.name }}-->

<!--                                                <svg-->
<!--                                                    class="ml-2 -mr-0.5 h-4 w-4"-->
<!--                                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                                    viewBox="0 0 20 20"-->
<!--                                                    fill="currentColor"-->
<!--                                                >-->
<!--                                                    <path-->
<!--                                                        fill-rule="evenodd"-->
<!--                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"-->
<!--                                                        clip-rule="evenodd"-->
<!--                                                    />-->
<!--                                                </svg>-->
<!--                                            </button>-->
<!--                                        </span>-->
<!--                                    </template>-->

<!--                                    <template #content>-->
<!--                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>-->
<!--                                        <DropdownLink :href="route('logout')" method="post" as="button">-->
<!--                                            Log Out-->
<!--                                        </DropdownLink>-->
<!--                                    </template>-->
<!--                                </Dropdown>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        &lt;!&ndash; Hamburger &ndash;&gt;-->
<!--                        <div class="-mr-2 flex items-center sm:hidden">-->
<!--                            <button-->
<!--                                @click="showingNavigationDropdown = !showingNavigationDropdown"-->
<!--                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"-->
<!--                            >-->
<!--                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">-->
<!--                                    <path-->
<!--                                        :class="{-->
<!--                                            hidden: showingNavigationDropdown,-->
<!--                                            'inline-flex': !showingNavigationDropdown,-->
<!--                                        }"-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        stroke-width="2"-->
<!--                                        d="M4 6h16M4 12h16M4 18h16"-->
<!--                                    />-->
<!--                                    <path-->
<!--                                        :class="{-->
<!--                                            hidden: !showingNavigationDropdown,-->
<!--                                            'inline-flex': showingNavigationDropdown,-->
<!--                                        }"-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        stroke-width="2"-->
<!--                                        d="M6 18L18 6M6 6l12 12"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

<!--                &lt;!&ndash; Responsive Navigation Menu &ndash;&gt;-->
<!--                <div-->
<!--                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"-->
<!--                    class="sm:hidden"-->
<!--                >-->
<!--                    <div class="pt-2 pb-3 space-y-1">-->
<!--                        <ResponsiveNavLink :href="route('assets')" :active="route().current('assets')">-->
<!--                            Assets-->
<!--                        </ResponsiveNavLink>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Responsive Settings Options &ndash;&gt;-->
<!--                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">-->
<!--                        <div class="px-4">-->
<!--                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">-->
<!--                                {{ $page.props.auth.user.name }}-->
<!--                            </div>-->
<!--                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>-->
<!--                        </div>-->

<!--                        <div class="mt-3 space-y-1">-->
<!--                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>-->
<!--                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">-->
<!--                                Log Out-->
<!--                            </ResponsiveNavLink>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </nav>-->

<!--            &lt;!&ndash; Page Heading &ndash;&gt;-->
<!--            <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">-->
<!--                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">-->
<!--                    <slot name="header" />-->
<!--                </div>-->
<!--            </header>-->

<!--            &lt;!&ndash; Page Content &ndash;&gt;-->
<!--            <main>-->
<!--                <slot />-->
<!--            </main>-->
<!--        </div>-->
<!--    </div>-->
</template>

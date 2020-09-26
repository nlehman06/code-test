<template>
  <nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <div class="font-semibold text-2xl text-white">{{ title }}</div>
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a
                href="/products"
                class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                >Browse</a
              >

              <a
                href="/my-products"
                class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                >My Products</a
              >
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <!-- Profile dropdown -->
            <div class="ml-3 relative">
              <div>
                <button
                  class="bg-blue-100 flex flex-shrink-0 h-10 items-center justify-center rounded-full text-2xl text-blue-700 w-10"
                  id="user-menu"
                  aria-label="User menu"
                  aria-haspopup="true"
                  @click="showProfileDropdown = !showProfileDropdown"
                >
              {{ user.firstName[0] }}{{ user.lastName[0]}}
                </button>
              </div>
              <transition
                enter-active-class="transition ease-out duration-100 transform"
                enter-class="opacity-0 scale-95"
                enter-to-class="opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75 transform"
                leave-class="opacity-100 scale-100"
                leave-to-class="opacity-0 scale-95"
              >
                <div
                  v-show="showProfileDropdown"
                  class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg"
                >
                  <div
                    class="py-1 rounded-md bg-white shadow-xs"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="user-menu"
                  >
                    <a
                      href="#"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                      role="menuitem"
                      @click="logoff()"
                      >Sign out</a
                    >
                  </div>
                </div>
              </transition>
            </div>
          </div>
        </div>
        <div class="-mr-2 flex md:hidden">
          <!-- Mobile menu button -->
          <button
            @click="showProfileDropdown = !showProfileDropdown"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white"
          >
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg
              class="block h-6 w-6"
              stroke="currentColor"
              fill="none"
              viewBox="0 0 24 24"
              v-show="!showProfileDropdown"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg
              class="hidden h-6 w-6"
              stroke="currentColor"
              fill="none"
              viewBox="0 0 24 24"
              v-show="showProfileDropdown"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!--
                Mobile menu, toggle classes based on menu state.

                Open: "block", closed: "hidden"
            -->
    <div class="md:hidden" v-show="showProfileDropdown">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <a
          href="/products"
          class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
          >Browse</a
        >

        <a
          href="/my-products"
          class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
          >My Products</a
        >
      </div>
      <div class="pt-4 pb-3 border-t border-gray-700">
        <div class="flex items-center px-5 space-x-3">
          <div class="bg-blue-100 flex flex-shrink-0 h-10 items-center justify-center rounded-full text-2xl text-blue-700 w-10">
              {{ user.firstName[0] }}{{ user.lastName[0]}}
          </div>
          <div class="space-y-1">
            <div class="text-base font-medium leading-none text-white">
              {{ user.firstName }} {{ user.lastName}}
            </div>
            <div class="text-sm font-medium leading-none text-gray-400">
              {{ user.email }}
            </div>
          </div>
        </div>
        <div class="mt-3 px-2 space-y-1">
          <a
            href="#"
            @click="logoff()"
            class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
            >Sign out</a
          >
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  props: ["user", "title"],
  data() {
    return {
      showProfileDropdown: false,
    };
  },
  methods: {
    logoff() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.post("/logout").then((response) => {
          window.location.href = "/";
        });
      });
    },
  },
};
</script>

<style>
</style>

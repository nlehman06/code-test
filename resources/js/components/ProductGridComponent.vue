<template>
  <div class="grid grid-cols-3 gap-4">
    <!-- component -->
    <div
      class="mx-auto px-4 py-8 max-w-xl flex flex-col"
      v-for="product in products"
      v-bind:key="product.id"
    >
      <div class="flex-1 bg-white shadow-2xl rounded-lg mb-6 tracking-wide">
        <div class="md:flex-shrink-0">
          <img
            :src="product.image"
            alt="mountains"
            class="w-full h-64 rounded-lg rounded-b-none"
          />
        </div>
        <div class="px-4 py-2 mt-2">
          <h2 class="font-bold text-2xl text-gray-800 tracking-normal">
            {{ product.name }}
          </h2>
          <p class="text-sm text-gray-700 px-2 mr-1">
            {{ product.description }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [],
    };
  },
  methods: {
    loadProducts() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.get("/api/product").then((response) => {
          this.products = response.data;
        });
      });
    },
  },
  created: function () {
    this.loadProducts();
  },
};
</script>

<style>
</style>

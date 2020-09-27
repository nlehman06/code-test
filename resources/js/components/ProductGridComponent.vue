<template>
  <div>
    <div class="flex justify-end">
      <button
        v-if="type === 'all'"
        @click="createProduct()"
        class="group relative w-full sm:w-1/2 md:w-1/4 flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-gray-600 hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-700 transition duration-150 ease-in-out"
      >
        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
          <svg
            class="h-5 w-5 text-gray-500 group-hover:text-gray-400 transition ease-in-out duration-150"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
            ></path>
          </svg>
        </span>
        Create Product
      </button>
    </div>
    <div class="grid lg:grid-cols-3 gap-4">
      <!-- component -->
      <div
        class="mx-auto px-4 py-8 max-w-xl flex flex-col w-full"
        v-for="product in products"
        v-bind:key="product.id"
      >
        <div
          class="flex flex-col justify-between flex-1 bg-white shadow-2xl rounded-lg mb-6 tracking-wide"
        >
          <div>
            <div class="md:flex-shrink-0">
              <img
                v-if="product.image"
                :src="product.image"
                :alt="product.name"
                class="w-full h-64 rounded-lg rounded-b-none object-contain"
              />
              <div
                v-if="!product.image"
                class="w-full h-64 rounded-lg rounded-b-none"
              ></div>
            </div>
            <div class="px-4 py-2 mt-2">
              <h2 class="font-bold text-2xl text-gray-800 tracking-normal">
                {{ product.name }}
              </h2>
              <p class="text-sm text-gray-700 px-2 mr-1 py-8">
                {{ product.description }}
              </p>
            </div>
          </div>
          <div>
            <div class="flex justify-around pb-8">
              <div class="font-bold text-2xl text-gray-800">
                {{ price(product.price) }}
              </div>
              <div>
                <button
                  v-if="canEdit"
                  @click="editProduct(product)"
                  class="hover:text-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:text-gray-700 transition duration-150 ease-in-out"
                >
                  <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                    ></path>
                  </svg>
                </button>
              </div>
            </div>
            <div class="flex items-center justify-center">
              <button
                v-show="canAdd"
                @click="addProduct(product)"
                class="group relative w-3/4 mb-8 flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-gray-600 hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-700 transition duration-150 ease-in-out"
              >
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                  <svg
                    class="h-5 w-5 text-gray-500 group-hover:text-gray-400 transition ease-in-out duration-150"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                    ></path>
                  </svg>
                </span>
                Add to your products
              </button>
              <button
                v-show="type === 'my'"
                @click="removeProduct(product)"
                class="group relative w-3/4 mb-8 flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-gray-600 hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-700 transition duration-150 ease-in-out"
              >
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                  <svg
                    class="h-5 w-5 text-gray-500 group-hover:text-gray-400 transition ease-in-out duration-150"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                    ></path>
                  </svg>
                </span>
                Remove
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <card-modal
      :product="productToEdit"
      :showing="modalShowing"
      @close="closeModal()"
    ></card-modal>
  </div>
</template>

<script>
const formatter = new Intl.NumberFormat("en-US", {
  style: "currency",
  currency: "USD",
  minimumFractionDigits: 2,
});
export default {
  props: {
    type: {
      type: String,
      default: "all",
    },
    isSubscribed: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      products: [],
      modalShowing: false,
      productToEdit: {},
    };
  },
  computed: {
    url: function () {
      return this.type === "all" ? "/api/product" : "/api/myProducts";
    },
    canAdd: function () {
      return this.isSubscribed && this.type === "all";
    },
    canEdit: function () {
      return this.type === "all";
    },
  },
  methods: {
    loadProducts() {
      axios
        .get("/sanctum/csrf-cookie")
        .then((response) => {
          axios
            .get(this.url)
            .then((response) => {
              this.products = response.data;
            })
            .catch((error) => {
              if (error.response.status === 401) {
                window.location.href = "/login";
              }
              console.log(error.response.status);
            });
        })
        .catch(() => {
          console.log(response);
        });
    },
    addProduct(product) {
      axios
        .get("/sanctum/csrf-cookie")
        .then((response) => {
          axios
            .post("/api/myProducts", { productId: product.id })
            .then((response) => {
              // returns list of my products.  Could be used to determine if product is already added.
            })
            .catch(() => {
              if (error.response.status === 401) {
                window.location.href = "/login";
              }
              console.log(error.response.status);
            });
        })
        .catch(() => {
          console.log(response);
        });
    },
    removeProduct(product) {
      axios
        .get("/sanctum/csrf-cookie")
        .then((response) => {
          axios
            .delete("/api/myProducts", { data: { productId: product.id } })
            .then((response) => {
              this.products = response.data;
            })
            .catch(() => {
              if (error.response.status === 401) {
                window.location.href = "/login";
              }
              console.log(error.response.status);
            });
        })
        .catch(() => {
          console.log(response);
        });
    },
    editProduct(product) {
      this.productToEdit = JSON.parse(JSON.stringify(product));
      this.modalShowing = true;
    },
    createProduct() {
      this.productToEdit = {
        name: "",
        description: "",
        price: 0,
      };
      this.modalShowing = true;
    },
    price(rawPrice) {
      return formatter.format(rawPrice / 100);
    },
    closeModal() {
      this.loadProducts();
      this.modalShowing = false;
    },
  },
  created: function () {
    this.loadProducts();
  },
};
</script>

<style>
</style>

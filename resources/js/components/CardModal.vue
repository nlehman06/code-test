<template>
  <Transition name="fade">
    <div
      v-if="showing"
      class="fixed inset-0 w-full h-screen flex items-center justify-center bg-black bg-opacity-75"
      @click.self="close"
    >
      <div class="relative w-full max-w-2xl bg-white shadow-lg rounded-lg p-8">
        <button
          aria-label="close"
          class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4"
          @click.prevent="close"
        >
          ×
        </button>
        <form @submit.prevent="save()">
          <div class="flex">
            <h2 class="text-3xl">{{ title }}</h2>
            <button
              aria-label="delete"
              class="text-xl text-gray-500 my-2 mx-4 hover:text-red-300"
              @click.prevent="deleteProduct()"
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
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                ></path>
              </svg>
            </button>
          </div>
          <div class="pt-4">
            <label
              for="name"
              class="block text-sm leading-5 font-medium text-gray-700"
              >Name</label
            >
            <div class="mt-1 relative rounded-md shadow-sm">
              <input
                v-model="product.name"
                id="name"
                class="form-input block w-full sm:text-sm sm:leading-5"
                placeholder="Jane Smith"
              />
            </div>
          </div>
          <div class="pt-4">
            <label
              for="description"
              class="block text-sm leading-5 font-medium text-gray-700"
              >Description</label
            >
            <div class="mt-1 relative rounded-md shadow-sm">
              <textarea
                v-model="product.description"
                id="description"
                class="form-textarea block w-full sm:text-sm sm:leading-5"
              ></textarea>
            </div>
          </div>
          <div class="pt-4">
            <label
              for="price"
              class="block text-sm leading-5 font-medium text-gray-700"
              >Price</label
            >
            <div class="mt-1 relative rounded-md shadow-sm">
              <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
              >
                <span class="text-gray-500 sm:text-sm sm:leading-5"> $ </span>
              </div>
              <input
                v-model="price"
                id="price"
                class="form-input block w-full pl-7 sm:text-sm sm:leading-5"
              />
            </div>
          </div>
          <div class="pt-4">
            <label
              for="image"
              class="block text-sm leading-5 font-medium text-gray-700"
              >Change Image</label
            >
            <div class="mt-1 relative rounded-md shadow-sm">
              <input
                type="file"
                accept="image/*"
                @change="uploadImage($event)"
                id="file-input"
              />
            </div>
          </div>
          <div class="pt-4 flex items-center justify-center">
            <button
              @click="save()"
              class="group relative w-1/4 mb-8 flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-gray-600 hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-700 transition duration-150 ease-in-out"
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
                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"
                  ></path>
                </svg>
              </span>
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </Transition>
</template>

<script>
export default {
  props: {
    showing: {
      required: true,
      type: Boolean,
    },
    product: {
      required: true,
      type: Object,
    },
  },
  computed: {
    price: {
      get: function () {
        return this.product.price / 100;
      },
      set: function (newValue) {
        this.product.price = Math.round(newValue * 100);
      },
    },
    title: function () {
      return this.product.id ? "Edit Product" : "Create Product";
    },
  },
  watch: {
    showing(value) {
      if (value) {
        return document.querySelector("body").classList.add("overflow-hidden");
      }

      document.querySelector("body").classList.remove("overflow-hidden");
    },
  },
  methods: {
    save() {
      if (this.product.id) {
        this.update();
      } else {
        this.create();
      }
    },
    update() {
      axios
        .get("/sanctum/csrf-cookie")
        .then((response) => {
          axios
            .patch(`/api/product/${this.product.id}/update`, this.product)
            .then((response) => {
              this.close();
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
    create() {
      axios
        .get("/sanctum/csrf-cookie")
        .then((response) => {
          axios
            .post(`/api/product`, this.product)
            .then((response) => {
              this.close();
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
    deleteProduct() {
      axios
        .get("/sanctum/csrf-cookie")
        .then((response) => {
          axios
            .delete(`/api/product/${this.product.id}`)
            .then((response) => {
              this.close();
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
    uploadImage(event) {
      let data = new FormData();
      console.log(event.target)
      data.append("image", event.target.files[0]);
      let config = {
        header: {
        //   "Content-Type": "image/png",
          "Content-Type": "multipart/form-data",
        },
      };
      axios
        .get("/sanctum/csrf-cookie")
        .then((response) => {
          axios
            .post(`/api/product/${this.product.id}/upload`, data, config)
            .then((response) => {
                // Display some sort of success message and continue on with the form.
            })
            .catch((error) => {
              if (error.response.status === 401) {
                window.location.href = "/login";
              }
              console.log(error.response.data.errors);
            });
        })
        .catch(() => {
          console.log(response);
        });
    },
    close() {
      this.$emit("close");
    },
  },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.4s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>

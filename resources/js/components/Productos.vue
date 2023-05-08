<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <input type="text" placeholder="Buscar usuario" />
        <table class="table table-bordered" with="100%">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Imagen</th>
              <th scope="col">Name</th>
              <th scope="col">descripcion</th>
              <th scope="col">Precio</th>
              <th scope="col">Cantidad</th>
              <th
                scope="col"
                v-if="can('edit-products | change-status-products') || is('admin')"
              >
                Actions
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(product, index) in products.data" :key="index">
              <td scope="col">{{ product.id }}</td>
              <td scope="col"><img  :src= "'storage/'+product.image"  :alt="index" width="150px" height="150px"></td>
              <td scope="col">{{ product.title }}</td>
              <td scope="col">{{ product.description }}</td>
              <td scope="col">{{ '$'+product.price }}</td>
              <td scope="col">{{ product.stock }}</td>
              <td scope="col">{{ product.status ? "Activo" : "Inactivo" }}</td>
              <button
                type="button"
                class="btn btn-danger"
                @click="changeStatus(product.id, product.status)"
                v-if="can('change-status-products') || is('admin')"
              >
                Inhabilitar
              </button>
              <button
                type="button"
                class="btn btn-secondary"
                v-if="can('edit-products') || is('admin')"
              >
                Editar
              </button>
              <button
                type="button"
                class="btn btn-secondary"
                v-if="can('edit-products') || is('admin')"
              >
                crear
              </button>
            </tr>
          </tbody>
        </table>
        <paginator
          :current_page="products.current_page"
          :last_page="products.last_page"
          :on-page-change="changePage"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: {},
      current_page: 1,
      last_page: 0,
    };
  },
  created() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts(page = 1) {
      const response = await axios.get(`productos/all?page=${page}`);
      this.products = response.data;
      this.current_page = response.data.current_page;
      this.last_page = response.data.last_page;
    },
    async changeStatus(id, status) {
      const response = await axios.put("productos/update_status/" + id, {
        status: !status ? 1 : 0,
      });
      this.fetchProducts();
    },
    changePage(page) {
      this.fetchProducts(page);
    },
  },
};
</script>

<template>
  <div class="container">
    <div class="row" v-for="(items, key) in products" :key="key">
      <div class="col-md-4" v-for="(product, index) in items" :key="index">
        <div class="product-card">
          <ul>
            <img
              v-bind:src="'/storage/images/' + product.image"
              :alt="index"
              width="50px"
              height="50px"
            />
            <li scope="col">{{ product.title }}</li>
            <li scope="col">{{ product.description }}</li>
            <li scope="col">{{ "$" + product.price }}</li>
          </ul>
          <button class="btn btn-primary add-to-cart-btn" data-product="1">
            Agregar al carrito
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

  <script>
export default {
  data() {
    return {
      products: {},
    };
  },
  created() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      const response = await axios.get("catalog/products");
      this.products = response.data;
      this.products = this.chunk(this.products,3)
    },
    chunk (array, size){
        const chunks = [];
        let index = 0;

         while (index < array.length) {
        chunks.push(array.slice(index, index + size));
     index += size;
  }

  return chunks;
    }
  },
};
</script>

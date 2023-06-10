<template>
  <div class="container">
    <!-- <input type="text" placeholder="Realizar busqueda" width="100%auto"> -->
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
          <button @click="addToCard(product)" class="btn btn-primary add-to-cart-btn" data-product="1">
            Agregar al carrito
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

  <script>
  import bus from '../../bus'
export default {
  data() {
    return {
        cartItems:[],
      products: {},
    };
  },
  created() {
    this.fetchProducts();
    this.cartItems= JSON.parse(localStorage.getItem('cart'))
  },
  methods: {
    async fetchProducts() {
      const response = await axios.get("catalog/products");
      this.products = response.data;
      this.products = this.chunk(this.products,3)
    },
    addToCard(product){
        this.cartItems.push(product)
        localStorage.setItem('cart',JSON.stringify(this.cartItems))
        bus.emit('cart-storage',this.cartItems)
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

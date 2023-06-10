<template>
  <a href="#" class="me-2 mt-2">
    <i class="fas fa-shopping-cart"></i>{{ cartCount }}
  </a>
</template>

  <script>
import bus from '../../bus'
export default {
  data() {
    return {
        cartCount:0,
    };
  },
  mounted() {
    this.cartCount=JSON.parse(localStorage.getItem('cart')).length || 0
    bus.on('cart-storage',(products)=>{
        this.cartCount = products.length
    })
  },
  methods: {

  },
  computed:{
    // cartCount:{
    //     get(){
    //         let cart = JSON.parse(localStorage.getItem('cart'))
    //         return cart.length || ""
    //     }
    // }
  }
};
</script>

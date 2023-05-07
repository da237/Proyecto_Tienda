<template>
    <div class="paginator">
      <nav>
        <ul class="pagination">
          <li :class="{'disabled': current_page === 1}" class="page-item">

            <!-- <a href="#" aria-label="Previous" @click.prevent="changePage(current_page - 1)">
              <span aria-hidden="true">&laquo;</span>
            </a> -->
            <button class="page-link" @click.prevent="changePage(current_page - 1)">Anterior</button>
          </li>
          <li v-for="page in pages" :key="page" :class="{'active': page === current_page}" class="page-item">
            <!-- <a href="#" @click.prevent="changePage(page)">{{ page }}</a> -->
            <button class="page-link" @click.prevent="changePage(page)">{{ page }}</button>
          </li>
          <li :class="{'disabled': current_page === last_page}" class="page-item">
            <!-- <a href="#" aria-label="Next" @click.prevent="changePage(current_page + 1)">
              <span aria-hidden="true">&raquo;</span>
            </a> -->
            <button class="page-link" @click.prevent="changePage(current_page + 1)">Siguiente</button>
          </li>
        </ul>
      </nav>
    </div>
  </template>

  <script>
  export default {
    props: {
      current_page: {
        type: Number,
        required: true
      },
      last_page: {
        type: Number,
        required: true
      },
      onPageChange: {
        type: Function,
        required: true
      }
    },
    computed: {
      pages() {
        let from = Math.max(1, this.current_page - 2);
        let to = Math.min(this.last_page, this.current_page + 2);

        if (to - from < 4) {
          from = Math.max(1, to - 4);
          to = Math.min(this.last_page, from + 4);
        }

        const pagesArray = [];

        for (let i = from; i <= to; i++) {
          pagesArray.push(i);
        }

        return pagesArray;
      }
    },
    methods: {
      changePage(page) {
        if (page >= 1 && page <= this.last_page && page !== this.current_page) {
          this.onPageChange(page);
        }
      }
    }
  }
  </script>

<template>
    <div>
        <h3>Books</h3>
        <router-link :to="{ name: 'add' }">Add</router-link>
        <div v-if="books.length == 0">
            No books found
        </div>
        <div v-for="book in books" :key="book.id">
            <p>{{ book.name }}</p>
            <router-link :to="{ name: 'edit', params: { id: book.id } }">Edit</router-link>
            <button @click="deleteBook(book.id)">Delete</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            books: [],
            ROOT_URL: process.env.MIX_API_URL_ROOT
        }
    },
    mounted() {
        this.axios
            .get(this.ROOT_URL)
            .then((response) => {
                this.books = response.data.data;
            });
    },
    methods: {
        deleteBook(id) {
            this.axios
                .delete(this.ROOT_URL + id)
                .then(response => {
                    let i = this.books.map(item => item.id).indexOf(id);
                    this.books.splice(i,1);
                })
        }
    }
}
</script>

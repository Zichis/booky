<template>
    <div>
        <div v-if="books.length == 0">
            No books found
        </div>
        <div class="border-b py-2 mb-4" v-for="book in books" :key="book.id">
            <h2 class="text-gray-800 text-2xl">{{ book.name }}</h2>
            <div class="flex flex-wrap mb-1">
                <h3 class="px-2 py-1 mb-1 font-light text-sm rounded-full mr-1 border" v-for="author in book.authors" :key="author.id">{{ author }}</h3>
            </div>
            <div>
                <router-link class="font-light text-green-500 hover:text-green-600" :to="{ name: 'edit', params: { id: book.id } }">Edit</router-link>
                <button class="font-light text-red-500 hover:text-red-600" @click="deleteBook(book.id)">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../services/api'

export default {
    data() {
        return {
            books: [],
        }
    },
    mounted() {
        api
            .get('/api/v1/books/')
            .then((response) => {
                this.books = response.data.data;
            });
    },
    methods: {
        deleteBook(id) {
            api
                .delete('/api/v1/books/' + id)
                .then(response => {
                    let i = this.books.map(item => item.id).indexOf(id);
                    this.books.splice(i,1);
                })
        }
    }
}
</script>

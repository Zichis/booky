<template>
    <div>
        <button @click="back">Back</button>
        <h3 class="text-2xl text-gray-800 mb-2">Add</h3>
        <form @submit.prevent="addBook" class="w-full md:w-1/2 lg:w-1/3">
            <div class="mb-4">
                <label for="name" class="block text-gray-600 text-sm">Name</label>
                <input class="border rounded w-full appearance-none px-2 py-1" type="text" v-model="book.name" placeholder="Enter book name">
            </div>
            <div class="mb-4">
                <label for="isbn" class="block text-gray-600 text-sm">ISBN</label>
                <input class="border rounded w-full appearance-none px-2 py-1" type="text" v-model="book.isbn" placeholder="Enter ISBN">
            </div>
            <div class="mb-4">
                <label for="authos" class="block text-gray-600 text-sm">Authors</label>
                <v-select class="" taggable multiple v-model="book.authors"/>
            </div>
            <div class="mb-4">
                <label for="country" class="block text-gray-600 text-sm">Country</label>
                <input class="border rounded w-full appearance-none px-2 py-1" type="text" v-model="book.country" placeholder="Enter country">
            </div>
            <div class="mb-4">
                <label for="number_of_pages" class="block text-gray-600 text-sm">Pages</label>
                <input class="border rounded w-full appearance-none px-2 py-1" type="text" v-model="book.number_of_pages" placeholder="Enter number of pages">
            </div>
            <div class="mb-4">
                <label for="publisher" class="block text-gray-600 text-sm">Publisher</label>
                <input class="border rounded w-full appearance-none px-2 py-1" type="text" v-model="book.publisher" placeholder="Enter publisher">
            </div>
            <div class="mb-4">
                <label for="release_date" class="block text-gray-600 text-sm">Release Date</label>
                <date-picker
                    v-model="book.release_date"
                    value-type="format"
                    format="YYYY-MM-DD"
                    type="date"
                    placeholder="Select date"
                ></date-picker>
            </div>
            <button type="submit" class="bg-green-500 text-green-50 px-3 py-1 rounded hover:bg-green-600">Add Book</button>
        </form>
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import api from '../services/api';

export default {
    components: { DatePicker },
    data() {
        return {
            book: {},
        }
    },
    methods: {
        addBook() {
            api
                .post('/api/v1/books/', this.book)
                .then((response) => {
                    this.$router.push({name: 'home'});
                })
        },
        back() {
            this.$router.back();
        }
    }
}
</script>

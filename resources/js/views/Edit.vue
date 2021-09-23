<template>
    <div>
        <button class="text-gray-500 hover:text-gray-700 mb-2" @click="back">&#8826; Back</button>
        <h3 class="text-2xl text-gray-800 mb-2">Update Book</h3>
        <form @submit.prevent="updateBook" class="w-full md:w-1/2 lg:w-1/3">
            <div class="mb-4">
                <label for="name" class="block text-gray-600 text-sm">Name</label>
                <input class="border rounded w-full appearance-none px-2 py-1" type="text" v-model="book.name">
            </div>
            <div class="mb-4">
                <label for="isbn" class="block text-gray-600 text-sm">ISBN</label>
                <input class="border rounded w-full appearance-none px-2 py-1" type="text" v-model="book.isbn">
            </div>
            <div class="mb-4">
                <label for="authos" class="block text-gray-600 text-sm">Authors</label>
                <v-select class="" taggable multiple v-model="book.authors"/>
            </div>
            <div class="mb-4">
                <label for="country" class="block text-gray-600 text-sm">Country</label>
                <input class="border rounded w-full appearance-none px-2 py-1" type="text" v-model="book.country">
            </div>
            <div class="mb-4">
                <label for="number_of_pages" class="block text-gray-600 text-sm">Pages</label>
                <input class="border rounded w-full appearance-none px-2 py-1" type="text" v-model="book.number_of_pages">
            </div>
            <div class="mb-4">
                <label for="publisher" class="block text-gray-600 text-sm">Publisher</label>
                <input class="border rounded w-full appearance-none px-2 py-1" type="text" v-model="book.publisher">
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
            <button type="submit" class="bg-green-500 text-green-50 px-3 py-1 rounded hover:bg-green-600">Update</button>
        </form>
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

export default {
    components: { DatePicker },
    data() {
        return {
            book: {},
            ROOT_URL: process.env.MIX_API_URL_ROOT
        }
    },
    mounted() {
        this.axios
                .get(this.ROOT_URL + this.$route.params.id)
                .then((response) => {
                    let book = response.data.data;

                    if (book.length == 0) {
                        this.$router.push({name: 'home'});
                    }

                    this.book = response.data.data;
                });
    },
    methods: {
        updateBook() {
            this.axios
                .patch(this.ROOT_URL + this.$route.params.id, this.book)
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

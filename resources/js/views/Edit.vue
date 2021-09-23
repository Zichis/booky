<template>
    <div>
        <button @click="back">Back</button>
        <h3>Edit</h3>
            <form @submit.prevent="updateBook">
                <div>
                    <label>Name</label>
                    <input type="text" v-model="book.name">
                </div>
                <div>
                    <label>ISBN</label>
                    <input type="text" v-model="book.isbn">
                </div>
                <div>
                    <label>Authors</label>
                    <v-select taggable multiple v-model="book.authors"/>
                </div>
                <div>
                    <label>Country</label>
                    <input type="text" v-model="book.country">
                </div>
                <div>
                    <label>Pages</label>
                    <input type="text" v-model="book.number_of_pages">
                </div>
                <div>
                    <label>Publisher</label>
                    <input type="text" v-model="book.publisher">
                </div>
                <div>
                    <label>Release Date</label>
                    <date-picker
                        v-model="book.release_date"
                        value-type="format"
                        format="YYYY-MM-DD"
                        type="date"
                        placeholder="Select date"
                    ></date-picker>
                </div>
                <button type="submit" class="btn btn-primary">Update Book</button>
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
            ROOT_URL: process.env.MIX_APP_URL_ROOT
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

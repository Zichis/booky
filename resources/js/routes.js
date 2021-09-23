import Home from './views/Home.vue'
import EditBook from './views/Edit.vue'
import AddBook from './views/Add.vue'

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditBook
    },
    {
        name: 'add',
        path: '/add',
        component: AddBook
    }
];

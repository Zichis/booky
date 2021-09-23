<template>
    <div>
        <div class="flex justify-between bg-gray-800 p-5 shadow-md">
            <router-link :to="{ name: 'home' }" class="text-gray-100">
                <h3 class="font-semibold text-lg text-gray-50">Booky</h3>
            </router-link>
            <router-link :to="{ name: 'add' }" class="text-gray-100"> + Add</router-link>
        </div>
        <div class="p-5">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {}
</script>

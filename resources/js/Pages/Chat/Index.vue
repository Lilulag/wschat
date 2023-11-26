<template>

    <div class="mt-2">
        Chats
        <div class="flex mt-3 gap-2">

            <div class="w-1/2 border border-gray-300 bg-white rounded-md">
                Lorem ipsum dolor sit amet
            </div>
            <div class="w-1/2 border border-gray-300 bg-white rounded-md">
                <h2 class="mb-2">Users</h2>
                <div class="w-full border-b border-gray-100 flex align-center p-1" v-for="user in users">
                    <span>{{ user.id }}</span>
                    <span class="pl-1">{{ user.name }}</span>
                    <button class="ml-auto px-2 py-1 bg-sky-400 rounded text-white">Message</button>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Index",

    layout: MainLayout,

    props: {
        users: Array,
    },
}
</script>

<style scoped>

</style>

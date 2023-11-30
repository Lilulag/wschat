<template>

    <div class="mt-3">
        <h2 class="text-white font-bold text-2xl">Chats</h2>
        <div class="flex mt-4 gap-2">

            <div class="w-1/2 border border-gray-300 bg-white rounded-md">
                <h2 class="mb-2">Chats</h2>
                <div class="w-full border-b border-gray-100 flex align-center p-1" v-for="chat in chats">
                    <NavLink :href="route('chats.show', chat.id)">
                        <span>{{ chat.id }}</span>
                        <span class="pl-1">{{ chat.title }}</span>
                    </NavLink>
                </div>
            </div>
            <div class="w-1/2 border border-gray-300 bg-white rounded-md">
                <h2 class="mb-2">Users</h2>
                <div class="w-full border-b border-gray-100 flex align-center p-1" v-for="user in users">
                    <span>{{ user.id }}</span>
                    <span class="pl-1">{{ user.name }}</span>
                    <button @click.prevent="storeChat(user.id)" class="ml-auto px-2 py-1 bg-sky-400 rounded text-white">Message</button>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import NavLink from "@/Components/NavLink.vue";

export default {
    name: "Index",
    components: {NavLink},
    layout: MainLayout,

    props: {
        users: Array,
        chats: Array,
    },

    methods: {
        storeChat(userId) {
            this.$inertia.post('/chats', {'title': 'default chat', 'users': userId});
        },
    },
}
</script>

<style scoped>

</style>

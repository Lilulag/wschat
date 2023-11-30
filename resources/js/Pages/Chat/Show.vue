<template>

    <div class="mt-2">
        <h2 class="text-white">Chat {{ chat.title }}</h2>
        <div class="flex items-start mt-3 gap-2">

            <div class="w-2/5 border border-gray-300 bg-white rounded-md">
                <div class="py-1 px-2" v-for="user in chat.users">
                    <div v-if="+user.id !== this.$page.props.auth.user.id">
                        {{ user.name }}
                        <input v-model="body" />
                        <button
                            class="ml-1 p-2 bg-sky-400 rounded text-white"
                            @click.prevent="store"
                        >Send</button>
                    </div>
                </div>
            </div>
            <div class="w-3/5 border border-gray-300 bg-white rounded-md py-2 px-2">
                <div class="flex w-100" v-for="message in messages">
                    <div :class="['inline-block mb-1 py-2 px-2 border rounded',
                        message.is_owner ? 'ml-auto bg-sky-300 border-sky-400' : 'bg-sky-200 border-sky-300'
                    ]">
                        <div class="pr-1">{{ message.user_name }}</div>
                        <span class="pr-1">{{ message.body }}</span>
                        <span class="text-xs italic">{{ message.time }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Show",

    layout: MainLayout,

    props: {
        chat: Object,
        messages: Array,
    },

    methods: {
        store() {
            axios.post('/messages', {
                'chat_id': this.chat.id,
                'body': this.body,
                'user_ids[]': this.userIds,
            }).then((res) => {
                this.messages.push(res.data);
                this.body = '';
            });
        }
    },

    computed: {
        userIds() {
            return this.chat.users
                .map(user => user.id)
                .filter(user => user.id !== this.$page.props.auth.user.id)
        },
    },
}
</script>

<style scoped>

</style>

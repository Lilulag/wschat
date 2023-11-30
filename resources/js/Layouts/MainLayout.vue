<template>
    <div class="w-3/4 mx-auto">
        <NavLink class="no-underline hover:no-underline text-xl text-white hover:bg-sky-400 hover:text-white border-none hover:border-none px-3 py-2" :href="route('chats.index')">Chats</NavLink>
        <slot />
    </div>
</template>

<script>
import NavLink from "@/Components/NavLink.vue";
export default {
    name: "MainLayout",
    components: {NavLink}
}
</script>

<style scoped>

</style>

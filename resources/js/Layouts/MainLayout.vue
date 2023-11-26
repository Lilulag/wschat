<template>
    <div class="w-3/4 mx-auto">
        <NavLink :href="route('chats.index')">Chats</NavLink>
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

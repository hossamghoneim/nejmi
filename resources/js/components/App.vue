<template>
    <div>
        <Header/>
        <router-view></router-view>
    </div>
</template>

<script>
import Header from "./partials/Header";
export default {
    components: {Header}
}
</script>

<style scoped>

</style>

<template>
    <div>
        <Header v-if="show" :active="active" :categories="categories" />
        <router-view
            @active="changeActive"
            @show="handleShow"
            :categories="this.$route.name == 'home' ? categories : ''">
        </router-view>
        <Footer v-if="show" />
    </div>
</template>

<script>
import Header from "./partials/Header";
import Footer from "./partials/Footer";
export default {
    mounted() {
        if(this.$route.name == 'order' || this.$route.name == 'order_gift')
            this.show = false
        if(this.$route.name == 'category' && this.$route.params.id != '') {
            this.active = this.$route.params.id
        }
        axios.get('/request/get-categories')
            .then((res) => {
                this.categories = res.data
            })
    },
    components: {Header, Footer},
    data: function () {
        return {
            active: "",
            show: true,
            categories: []
        }
    },
    methods: {
        changeActive(id) {
            this.active = id
        },
        handleShow(show) {
            this.show = show
        }
    }
}
</script>

<style scoped>

</style>

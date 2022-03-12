<template>
    <div class="container category">
        <div class="row my-2 text-center">
            <div class="col-12">
                <h4 v-if="notFound">القسم غير موجود</h4>
                <h4 v-if="category">{{ category.name }}</h4>
            </div>
            <div class="col-12 text-center" v-if="users.length == 0 && !notFound">
                <h6 class="my-4">لا يوجد مشاهير في هذا القسم</h6>
            </div>
            <div class="col-6 col-md-3 mt-3" v-for="user in users" :key="user.id">
                <div class="single">
                    <img v-if="user.image" class="w-100" :src="'/images/users/' + user.image">
                    <img v-else src="/assets/images/default.png" class="w-100">
                    <router-link :to="'/user/' + user.id">
                        <h5>{{ user.name }}</h5>
                    </router-link>
                    <h6 v-if="user.price_ad">{{ user.price_ad }} $</h6>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    beforeRouteUpdate(to, from, next) {
        let id = to.params.id
        axios.get('/request/get-users-category/' + id)
            .then((res) => {
                if(res.data == 0) {
                    this.notFound = true
                    return
                }
                this.category = res.data
                this.users = res.data.users
            })
        next()
    },
    mounted() {
        let id = this.$route.params.id
        axios.get('/request/get-users-category/' + id)
        .then((res) => {
            if(res.data == 0) {
                this.notFound = true
                return
            }
            this.category = res.data
            this.users = res.data.users
        })
    },
    data: function () {
        return {
            users: [],
            category: "",
            notFound: false
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div class="container">

        <div class="hero">
            <div class="row">
                <div class="col-12">
                    <img src="assets/images/hero.jpg" alt="Hero">
                </div>
            </div>
        </div>

        <!-- Latest Section -->
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <h3>أحدث المشاهير</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-2 text-center mt-2" v-for="user in latest" :key="user.id">
                    <router-link v-if="user.image" :to="'/user/' + user.id">
                        <img :src="'/images/users/' + user.image" class="w-100 mb-2">
                    </router-link>
                    <router-link v-else :to="'/user/' + user.id">
                        <img src="/assets/images/default.png" class="w-100 mb-2">
                    </router-link>
                    <h5>
                        <router-link :to="'/user/'+user.id">{{ user.name }}</router-link>
                    </h5>
                    <h6 v-if="user.price_ad">{{ user.price_ad }}$</h6>
                </div>
            </div>
        </section>

        <!-- People Section -->
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <h3>عروض مميزة</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-2 text-center mt-2" v-for="user in latest" :key="user.id">
                    <router-link v-if="user.image" :to="'/user/' + user.id">
                        <img :src="'/images/users/' + user.image" class="w-100 mb-2">
                    </router-link>
                    <router-link v-else :to="'/user/' + user.id">
                        <img src="/assets/images/default.png" class="w-100 mb-2">
                    </router-link>
                    <h5>
                        <router-link :to="'/user/'+user.id">{{ user.name }}</router-link>
                    </h5>
                    <h6 v-if="user.price_ad">{{ user.price_ad }}$</h6>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
export default {
    mounted() {
        axios.get('/request/get-latest')
        .then((res) => {
            this.latest = res.data
        })
    },
    data: function () {
        return {
            latest: [],
        }
    }
}
</script>

<style scoped>
section img {
    height: 190px;
    border-radius: 5px;
}
</style>

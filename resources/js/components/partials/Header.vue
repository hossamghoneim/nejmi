<template>
    <nav>
        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div id="logo">
                            <h3>
                                <router-link to="/">LOGO</router-link>
                            </h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <div class="w-100 position-relative">
                                <input type="text"
                                       class="form-control"
                                       v-model="word"
                                       placeholder="بحث..."
                                       @keyup="search">
                                <div class="results" v-if="results.length">
                                    <ul>
                                        <li v-for="result in results" :key="result.id">
                                            <router-link :to="'/user/'+result.id" v-if="result.image" @click.native="results = [],word = ''">
                                                <img class="ml-2 circle"
                                                     :src="'/images/users/'+result.image"
                                                     width="40"
                                                     height="40">
                                                {{ result.name }}
                                            </router-link>
                                            <router-link :to="'/user/'+result.id" v-else>
                                                <img class="ml-2 circle"
                                                     src="/assets/images/default.png"
                                                     width="40"
                                                     height="40">
                                                {{ result.name }}
                                            </router-link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <router-link v-if="auth" to="/dashboard" class="text-decoration-none mr-2">حسابي</router-link>
                            <router-link v-else to="/login" class="text-decoration-none mr-2">دخول</router-link>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="menu">
                            <ul>
                                <li v-for="(category, index) in categories" :key="index">
                                    <router-link :to="'/category/'+category.id">{{ category.name }}</router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    mounted() {
        axios.get('/request/get-categories')
        .then((res) => {
            this.categories = res.data
        })
    },
    data: function () {
        return {
            auth: authUser,
            categories: [],
            word: "",
            results: []
        }
    },
    methods: {
        search() {
            axios.get('/request/search?word=' + this.word)
            .then((res) => {
                // console.log(res.data)
                this.results = res.data
            })
        }
    }
}
</script>

<style scoped>
.results {
    position: absolute;
    width: 100%;
    z-index: 9999;
    background-color: #eaeaea;
}
.results ul {
    padding: 10px;
    margin: 0;
}
.results ul li {
    margin: 5px 0;
    padding: 5px 0;
    border-bottom: 1px solid #d9d9d9;
}
.results ul li:last-child {
    border-bottom: 0;
    margin: 0;
    padding: 0;
}
</style>

<template>
     <div>
        <nav dir="rtl" class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <router-link to="/">
                        <img src="/assets/images/logo.png" alt="logo" />
                    </router-link>
                </a>
                <div class="d-flex align-items-center actions">
                    <span data-toggle="modal" data-target="#exampleModalCenter">
                        <img width="19" src="/assets/images/akar-icons_search.png" alt="search" />
                    </span>
                    <!-- Search Modal in mobile -->
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"> أختر نجمك المفضل </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-inline my-2 my-lg-0">
                                        <button class="" type="submit">
                                            <img src="/assets/images/akar-icons_search.png" width="19" alt="search">
                                        </button>
                                        <input @change="search" class="form-control" type="search" placeholder="اختر نجمك المفضل"
                                            aria-label="Search">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button @click="toggler" class="navbar-toggler" type="button"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="4" y1="6" x2="20" y2="6" />
                            <line x1="4" y1="12" x2="20" y2="12" />
                            <line x1="4" y1="18" x2="20" y2="18" />
                        </svg>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">الرئيسية <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item" v-for="category in this.categories" :key="category.id">
                            <router-link :to="'/category/'+category.id" class="nav-link">
                                {{ category.name }}
                            </router-link>
                        </li>


                    </ul>
                    <div class="register">
                        <form class="form-inline my-2 my-lg-0">
                            <button class="" type="submit">
                                <img src="/assets/images/akar-icons_search.png" width="19" alt="search">
                            </button>
                            <input @change="search" class="form-control" type="search" placeholder="اختر نجمك المفضل" aria-label="Search">
                        </form>
                        <div class="login_actions">
                            <router-link v-if="!isAuth" class="reg" to="/register">
                                سجل
                            </router-link>
                            <router-link v-if="!isAuth" class="log" to="/login">
                                تسجيل الدخول
                            </router-link>
                            <router-link v-if="isAuth" class="log" to="/account">
                                لوحة التحكم
                            </router-link>

                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <section class="links">
            <div dir="ltr" class="container-fluid">
                <carousel autoplayDirection="backword" :paginationEnabled="false" :navigationEnabled="true" v-if="(this.categories.length >= 1)" :perPage="8">

                    <slide v-for="(category, index) in categories" class="link" :key="index">
                        <router-link :to="'/category/'+category.id">
                            {{ category.name }}
                        </router-link>
                    </slide>
                    <slide class="link">
                        <router-link class="link" to="/">
                            الرئيسية
                        </router-link>
                    </slide>
                </carousel>
            </div>
        </section>
     </div>

</template>

<script>
import {Carousel, Slide} from 'vue-carousel';

export default {
    props: ['active', 'categories'],
    mounted() {
        axios.get("/request/checkAuth").then((res) => {
            this.isAuth = res.data;
            });
    },
    data: function () {
        return {
            auth: authUser,
            word: "",
            results: [],
            settings: settings,
            isAuth: false,
        }
    },
    methods: {
        search() {
            axios.get('/request/search?word=' + this.word)
            .then((res) => {
                // console.log(res.data)
                this.results = res.data
            })
        },
        toggler() {
            var element = document.getElementById("navbarSupportedContent");
            element.classList.toggle("show");
        },

    },
    components: {
        Carousel,
        Slide,
        },
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

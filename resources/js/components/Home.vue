<template>
    <div>


        <section class="hero"  dir="rtl">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="hero_content">
                            <h1>اطلب فيديو نجمي </h1>
                            <p>
                                فاجئ اصحابك بفيديو نجمي مخصوصي
                                لتعبر عن نجمك المفضل ...
                            </p>
                            <div class="actions">
                                <router-link class="reg" to="/login"> اكتشف النجوم </router-link>
                                <router-link class="log" to="/join"> انضم كنجم </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="/assets/images/hero.png" alt="hero" />
                    </div>
                </div>
            </div>
        </section>

        <section class="most_trend  trending" v-if="this.featured && this.featured.length">
            <div class="container-fluid">
                <div dir="rtl" class="head d-flex align-items-center justify-content-between">
                    <h2> كل المشاهير </h2>
                    <a href="#"> شاهد الكل </a>
                </div>
                <carousel :perPageCustom="[[0,1],[480, 2], [768, 3], [1000,4],[1200,5]]" :navigationClickTargetSize="0" :paginationEnabled="false" :navigationEnabled="true" :perPage="5" v-if="this.featured && this.featured.length" class="most_trend most_trend_owl ">
                    <slide v-for="artist in this.featured" :key="artist.id" class="link">
                        <router-link  :to="'/user/'+artist.username">
                            <img  :src="'/images/users/'+artist.image" class="img-radius" :alt="artist.name" />
                            <div class="desc">
                                <h5> {{ artist.name }} </h5>
                                <span> {{ artist.country.name }} , {{ artist.category.name }}</span>
                                <strong> {{ artist.price_gift }}  MRU  </strong>
                            </div>
                        </router-link>
                    </slide>


                </carousel>
            </div>
        </section>

        <section class="most_trend  trending" v-if="this.latest && this.latest.length">
            <div class="container-fluid">
                <div dir="rtl" class="head d-flex align-items-center justify-content-between">
                    <h2> الأكثر رواجا </h2>
                    <a href="#"> شاهد الكل </a>
                </div>
                <carousel :perPageCustom="[[0,1],[480, 2], [768, 3], [1000,4],[1200,5]]" :navigationClickTargetSize="0" :paginationEnabled="false" :navigationEnabled="true" :perPage="5"  v-if="this.latest && this.latest.length" class="most_trend most_trend_owl ">
                    <slide v-for="artist in this.latest" :key="artist.id" class="link">
                        <router-link  :to="'/user/'+artist.username">
                            <img  :src="'/images/users/'+artist.image" class="img-radius" :alt="artist.name" />
                            <div class="desc">
                                <h5> {{ artist.name }} </h5>
                                <span> {{ artist.country.name }} , {{ artist.category.name }}</span>
                                <strong> {{ artist.price_gift }}  MRU  </strong>
                            </div>
                        </router-link>
                    </slide>


                </carousel>
            </div>
        </section>

        <section class="most_trend  trending">
            <div class="container-fluid">
                <div dir="rtl" class="head d-flex align-items-center justify-content-between">
                    <div v-for="filter in this.filters" :key="filter.id" class="link">
                        <div class="desc">
                            <h2> فلتر الاسعار </h2> <span> {{ filter.price_filter }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="most_trend  trending first" v-if="this.views && this.views.length">
            <div dir="rtl" class="container-fluid">
                <div class="head d-flex align-items-center justify-content-between">
                    <h2> نجوم اولوا </h2>
                    <a href="#"> شاهد الكل </a>
                </div>
                <carousel  :perPageCustom="[[0,1],[480, 2], [768, 3], [1000,4],[1200,5]]" :navigationClickTargetSize="0" :paginationEnabled="false" :navigationEnabled="true" :perPage="5"  v-if="this.views && this.views.length" class="most_trend most_trend_owl ">
                    <slide v-for="artist in this.views" :key="artist.id" class="link">
                        <router-link  :to="'/user/'+artist.username">
                            <img  :src="'/images/users/'+artist.image" class="img-radius" :alt="artist.name" />
                            <div class="desc">
                                <h5> {{ artist.name }} </h5>
                                <span> {{ artist.country.name }} , {{ artist.category.name }}</span>
                                <strong> {{ artist.price_gift }}  MRU  </strong>
                            </div>
                        </router-link>
                    </slide>


                </carousel>
            </div>
        </section>

        <section class="most_trend music  trending first" v-for="category in this.categories" v-if="category.users.length >= 1">
            <div class="container-fluid">
                <div dir="rtl" class="head d-flex align-items-center justify-content-between">
                    <h2> {{ category.name }} </h2>
                    <router-link :to="'/category/'+category.id"> شاهد الكل </router-link>
                </div>
                <carousel :centerMode="true" :perPageCustom="[[0,1],[480, 2], [768, 3], [1000,4],[1200,5]]" :navigationClickTargetSize="0" :paginationEnabled="false" :navigationEnabled="true" :perPage="5"  v-if="category.users && category.users.length" class="most_trend most_trend_owl ">
                    <slide v-for="artist in category.users" :key="artist.id" class="link">
                        <router-link  :to="'/user/'+artist.username">
                            <img  :src="'/images/users/'+artist.image" class="img-radius" :alt="artist.name" />
                            <div class="desc">
                                <h5> {{ artist.name }} </h5>
                                <span> {{ artist.country.name }} , {{ artist.category.name }}</span>
                                <strong> {{ artist.price_gift }}  MRU  </strong>
                            </div>
                        </router-link>
                    </slide>


                </carousel>
            </div>
        </section>

        <section class="donation">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content">
                            <h3> الي حتدفع بيفرق </h3>
                            <p>
                                سواء هتفاجئ صحابك بفيديو من نجمي لنجمهم المفضل
                                او هتبعت رسالة مباشرة لنجمك المفضل، جزء من التكلفة هيروح
                                للجمعيات الخيرية.
                            </p>
                            <a href="#"> اكتشف نجومك الان </a>
                        </div>
                    </div>
                    <div class="col-lg-6 img_div">
                        <img src="/assets/images/hero.png" class="mw-100" alt="" />
                    </div>

                </div>
            </div>
        </section>

        <section class="subscribe">
            <div class="container-fluid">
                <div class="sub_holder d-flex flex-wrap  justify-content-center">
                    <div class="right_part">
                        <h3>اشترك في قائمة البريد خاصتنا</h3>
                        <p>
                            اشترك لمعرفة كل ما هو جديد عن نجومك المفضلة
                        </p>
                        <form action="">
                            <input type="email" placeholder="بريدك الالكتروني" />
                            <button> ارسال </button>
                        </form>
                    </div>
                    <div class="left_part">
                        <h3>انضم كنجم</h3>
                        <p>
                            لو عندك جمهور ومعجبين بشكل كبير
                            انضم الى نجمي ، وسنعطيك النصائح اللازمة
                        </p>

                        <a href="#"> انضم </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import myVideo from 'vue-video'

import {Carousel, Slide} from 'vue-carousel';

export default {
    props: ['categories'],

    mounted() {
        this.$emit('active', '')
        axios.get('/request/get-latest')
            .then((res) => {
                this.latest = res.data
            })
        axios.get('/request/get-prices-filter')
            .then((res) => {
                this.filters = res.data;
            })
        axios.get('/request/get-sliders')
            .then((res) => {
                this.sliders = res.data;
            })
        axios.get('/request/get-featured')
            .then((res) => {
                this.featured = res.data
            })
        axios.get('/request/get-special-videos')
            .then((res) => {
                this.videos = res.data
            })
        axios.get('/request/get-views')
            .then((res) => {
                this.views = res.data
            })
        axios.get('/request/get-price-filter')
            .then((res) => {
                this.prices = res.data.split(",")
            })
    },
    data: function () {
        return {
            latest: [],
            filters: [],
            featured: [],
            videos: [],
            views: {},
            showing_count: 200,
            prices: [],
            sliders: [],
        }
    },
    computed: {
        onlineUsers() {
            return this.latest.filter((el) => {
                if (el.is_online) return el
            })
        },
        videosTypeOne() {
            return this.videos.filter((el) => {
                if (el.video_type == 1) return el
            })
        },
        videosTypeTwo() {
            return this.videos.filter((el) => {
                if (el.video_type == 2) return el
            })
        }
    },
    methods: {
        changeShowingCount() {
            return this.latest.filter((el) => {
                if (el.price_gift < this.showing_count)
                    return el
            })
        }
    },
    components: {

        myVideo,
        Carousel,
        Slide,

    },
}
</script>


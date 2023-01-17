    <template>
        <div class="container-fluid ">
            <div class="row my-2 mt-4">
                <div class="col-12">
                    <div class="loading text-center" v-if="loading">
                    <i class="fa fa-spin fa-spinner"></i>
                    <h4 >جاري تحميل البيانات</h4>
                    </div>
                    <h2 class="text-center" v-if="category">{{ category.name }}</h2>

                </div>
                <div class="col-12 text-center" v-if="this.loading == false && notFound">
                    <h6 class="my-4">لا يوجد مشاهير في هذا القسم</h6>
                </div>

                <section class="most_trend  trending first" v-if="this.users && this.users.length">
                    <div dir="rtl" class="container-fluid row">
                        <div v-for="artist in this.users" :key="artist.id" class="link col-md-3 mb-4" style="margin-bottom:35px;">
                            <router-link  :to="'/user/'+artist.username">
                                <img  :src="'/images/users/'+artist.image" class="img-radius" :alt="artist.name" />
                                <div class="desc">
                                    <h5> {{ artist.name }} </h5>
                                    <span> {{ artist.country.name }} , {{ artist.category.name }}</span>
                                    <br>
                                    <strong> {{ artist.price_gift }}  MRU  </strong>
                                </div>
                            </router-link>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </template>

    <script>
    export default {
        beforeRouteUpdate(to, from, next) {
            this.users = []
            this.category = ""
            this.notFound = false
            this.loading = true
            let id = to.params.id
            this.$emit('active', id)
            if(id == 'best') {
                axios.get('/request/get-best-category/')
                    .then((res) => {
                        this.category = res.data.category
                        this.users = res.data.users
                        this.loading = false
                    })
                return
            } else if (id == 'latest') {
                axios.get('/request/get-latest-category/')
                    .then((res) => {
                        this.category = res.data.category
                        this.users = res.data.users
                        this.loading = false
                    })
                return
            } else {
                axios.get('/request/get-users-category/' + id)
                    .then((res) => {
                        if(res.data == 0) {
                            this.notFound = true
                            this.loading = false
                            return
                        }
                        this.category = res.data.category
                        this.users = res.data.users
                        this.loading = false
                    })
            }
            next()
        },
        mounted() {
            let id = this.$route.params.id
            this.$emit('active', id)
            if(id == 'best') {
                axios.get('/request/get-best-category/')
                    .then((res) => {
                        this.category = res.data.category
                        this.users = res.data.users
                        this.loading = false
                    })
                return
            } else if (id == 'latest') {
                axios.get('/request/get-latest-category/')
                    .then((res) => {
                        this.category = res.data.category
                        this.users = res.data.users
                        this.loading = false
                    })
                return
            } else {
                axios.get('/request/get-users-category/' + id)
                    .then((res) => {
                        if(res.data == 0) {
                            this.notFound = true
                            this.loading = false

                            return
                        }
                        this.category = res.data.category
                        this.users = res.data.users
                        this.loading = false
                    })
            }
        },
        data: function () {
            return {
                users: [],
                category: "",
                notFound: false,
                noData: 0,
                loading: true
            }
        },
        methods : {
            imageUrlAlt() {
                event.target.src = "/assets/images/default.png"
            }
        },
    }
    </script>

    <style>
    .loading {
        font-size: 32px;
        color: #25D366;
    }
    </style>

<template>
    <div class="container">
        <div class="row my-4" v-if="notFound || user.type == 0">
            <div class="col-12 text-center">
                <h3>المستخدم غير موجود</h3>
                <img src="/assets/images/not_found.svg" class="d-block" style="width: 400px;margin: 25px auto">
            </div>
        </div>
        <div class="row my-2" v-if="!notFound && user.type == 1">
            <div class="col-12">
                <div class="single-overview">
                    <img v-if="user.image"
                         class="circle"
                         style="width: 200px;height: 200px;"
                         :src="'/images/users/' + user.image">
                    <img v-else src="/assets/images/default.png" style="width: 200px;height: 200px;">
                    <h5 class="d-inline-block mx-3" v-if="user.name">{{ user.name }}</h5>
                    <ul class="single-cat-list">
                        <li v-if="user.category">
                            <router-link :to="'/category/'+user.category.id" class="bg-gr">{{ user.category.name }}</router-link>
                        </li>
                    </ul>
                    <p v-if="user.about">{{ user.about }}</p>
                    <p class="delivery">
                        التسليم خلال 24 ساعة
                    </p>
                    <router-link :to="'/order/' + user.id" class="btn btn-primary btn-block p-2">
                        اطلب إعلان مقابل
                        {{ user.price_ad }}$
                    </router-link>
                    <router-link :to="'/order-gift/' + user.id" class="btn btn-success btn-block p-2">
                        اطلب إهداء مقابل
                        {{ user.price_gift }}$
                    </router-link>
                </div>
            </div>
        </div>

        <!-- Videos -->
        <section v-if="!notFound && user.type == 1" class="section">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-heading">
                        <span>الفيديوهات</span>
                    </h3>
                </div>
            </div>
            <div class="row" v-if="user.videos && user.videos.length">
                <div class="col-12 col-md-4" v-for="(video, index) in user.videos" :key="index">
                    <video :src="'/videos/' + video.video" class="w-100" height="340" controls>
                        <source :src="'/videos/' + video.video" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="text-center" v-else>
                <p>لا يوجد فيديوهات</p>
            </div>
        </section>
        <!-- People Section -->
        <section v-if="!notFound && user.type == 1 && related.length" class="section discover">
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="section-heading">
                        <span>اكتشف أيضاً</span>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3 text-center" v-for="rel in related" :key="rel.id">
                    <router-link :to="'/user/' + rel.id" v-if="rel.image">
                        <img :src="'/images/users/'+rel.image" class="w-100">
                    </router-link>
                    <router-link :to="'/user/' + rel.id" v-else>
                        <img src="/assets/images/default.png" class="w-100">
                    </router-link>
                    <h5>
                        <router-link :to="'/user/' + rel.id">{{ rel.name }}</router-link>
                    </h5>
                    <h6 v-if="rel.price_gift">{{ rel.price_gift }}$</h6>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    beforeRouteUpdate(to, from, next) {
        let id = to.params.id
        axios.get('/request/get-user/' + id)
            .then((res) => {
                if(res.data == 0) {
                    this.notFound = true
                    return
                }
                // console.log(res.data)
                this.user = res.data.user
                this.related = res.data.related
            })
        window.scrollTo(0,0);
        next()
    },
    mounted() {
        let id = this.$route.params.id
        axios.get('/request/get-user/' + id)
            .then((res) => {
                if(res.data == 0) {
                    this.notFound = true
                    return
                }
                // console.log(res.data)
                this.user = res.data.user
                this.related = res.data.related
            })
    },
    data: function () {
        return {
            notFound: false,
            user: "",
            order: {
                message: "",
                order_type: "",
                target_id: ""
            },
            related: []
        }
    },
    methods: {
        newOrder() {
            this.order.target_id = this.user.id
            axios.post('/request/create-order', {
                data: this.order
            })
            .then((res) => {
                if(res.data == 1) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'تم إرسال الطلب بنجاح'
                    })
                    this.order.message = ""
                    this.order.order_type = ""
                    this.showOrder = false
                }
            })
        }
    }
}
</script>

<style scoped>
video {
    margin: 10px 0;
    border: 1px solid #eee;
}
.discover img {
    border-radius: 10px;
    margin-bottom: 15px;
}
</style>

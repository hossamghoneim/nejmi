<template>
     <div>
        <div class="bread" v-if="!notFound && user.type == 1">
            <div class="container-fluid">
                <span>الرئيسية | </span>
                <span> {{ user.category.name }} | </span>
                <a href="#"> {{ user.name }} </a>
            </div>
        </div>
        <section class="artist_info">
            <div class="container-fluid">
                <div class="artis_wrapper">
                    <div class="row" dir="rtl">
                        <div class="col-xl-6">
                            <div class="right_part d-flex">

                                <ul class="nav thumbs nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#first">
                                            <div class="position-relative">
                                                <img :src="'/images/users/'+user.image" alt="">
                                                <img src="/assets/images/paly.png" class="play" alt="">
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#second">
                                            <div class="position-relative">
                                                <img :src="'/images/users/'+user.image" alt="">
                                                <img src="/assets/images/paly.png" class="play" alt="">
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#third">
                                            <div class="position-relative">
                                                <img :src="'/images/users/'+user.image" alt="">
                                                <img src="/assets/images/paly.png" class="play" alt="">
                                            </div>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="first" class=" tab-pane active">
                                        <div class="main_img videoContainer">
                                           <Myvideo class="video"  :sources="[{
                                            // video uri
                                            src : '/video/'+user.video,
                                            // video meta type
                                            type: 'video/mp4'
                                        }]"></Myvideo>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="left_part">
                                <h2> {{ user.name }} </h2>
                                <h6> {{ user.category.name }} </h6>
                                 <div class="rate d-flex align-items-center">
                                    <div class="start">
                                        <img src="/assets/images/star.png" alt="">
                                        <img src="/assets/images/star.png" alt="">
                                        <img src="/assets/images/star.png" alt="">
                                        <img src="/assets/images/star.png" alt="">
                                        <img src="/assets/images/star.png" alt="">
                                    </div>
                                    <span> 22.5 تقييم </span>
                                </div>
                                 <div class="rate_mobile">
                                    <img src="/assets/images/star.png" alt="">
                                    <span>5.00</span>
                                </div>
                                <p class="desc">
                                 {{ user.about }}
                                </p>

                                <div class="make_choise">
                                    <h4> <span> حدد اختيارك </span> </h4>
                                </div>

                                <div class="options">
                                    <div @click="changeUrl('gift')" id="gift" class="gift_opt">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="label">
                                                <img src="/assets/images/gift.png" alt="">
                                                <span> فيديو اهداء </span>
                                            </div>
                                            <span class="price">{{ user.price_gift }} MRU </span>
                                        </div>
                                        <p>فيديو خاص لتفاجئ نفسك أو من تحب! </p>
                                    </div>
                                    <div @click="changeUrl('ad')" id="ad" style="border: red 2px solid" class="gift_opt envelope_opt">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="label">
                                                <img src="/assets/images/envelope.png" alt="">
                                                <span> طلب دعاية </span>
                                            </div>
                                            <span class="price">{{ user.price_ad }} MRU </span>
                                        </div>

                                        <p>فيديو اعلان او دعاية لمنتجك او لشركتك</p>
                                    </div>
                                    <router-link :to="url+user.id"  class="order_now d-block"> اطلب الان </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <section class="share" dir="rtl">
                    <div class="container-fluid">
                        <div class="share_content d-flex">
                            <img src="/assets/images/share.png" alt="share" />
                            <div>
                                <h3>شارك بعطفك</h3>
                                <p>
                                    اللي هتدفعه بيفرق. كل مرة هتشتري من نجمي ، هنتبرع بجزء من ثمنه
                                    <span> لمؤسسة مجدي يعقوب.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="most_trend  trending first" v-if="this.related && this.related.length">
                    <div dir="rtl" class="container-fluid">
                        <div class="head d-flex align-items-center justify-content-between">
                            <h2> شاهد المزيد </h2>

                        </div>
                        <carousel  :perPageCustom="[[0,1],[480, 2], [768, 3], [1000,4],[1200,5]]" :navigationClickTargetSize="0" :paginationEnabled="false" :navigationEnabled="false" :perPage="5"  v-if="this.related && this.related.length" class="most_trend most_trend_owl ">
                            <slide v-for="artist in this.related" :key="artist.id" class="link">
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
            </div>
        </section>
    </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
import Myvideo from 'vue-video'

export default {
    beforeRouteUpdate(to, from, next) {
        this.$emit('active', '')
        this.$emit('show', true)
        let username = to.params.username
        axios.get('/request/get-user/' + username)
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
        this.$emit('active', '')
        this.$emit('show', true)
        let username = this.$route.params.username
        axios.get('/request/get-user/' + username)
            .then((res) => {
                if(res.data == 0) {
                    this.notFound = true
                    return
                }
                console.log(res.data.user);
                this.user = res.data.user
                this.related = res.data.related
                this.inSameCountry = res.data.sameCountry
                this.videos = res.data.videos

            })
        axios.get('/request/get-donation-image')
        .then((res) => {
            this.donation_image = res.data
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
            related: [],
            inSameCountry : [],
            url: window.location.href,
            donation_image: "",
            videos : [],
            url : "/order/",
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
        },
        playVideo(videoId) {
            var video = document.getElementById(videoId);
            video.play();

            var playBtn = document.getElementById('play-'+videoId);
            playBtn.style.visibility = 'hidden';

            document.getElementById('pause-'+videoId).style.visibility = 'visible';
        },
        pauseVideo(videoId) {
            var video = document.getElementById(videoId);
            video.pause();
            var playBtn = document.getElementById('play-'+videoId);
            playBtn.style.visibility = 'visible';

            document.getElementById('pause-'+videoId).style.visibility = 'hidden';
        },
        putSrcsforVideos() {
            var hostname = window.location.hostname;
            if(hostname == '127.0.0.1') {
                hostname = 'https://127.0.0.1:8000';
            } else {
                hostname = 'https://' + hostname;
            }
            if(this.videos.length >=  1) {
                    for(var i = 0; i < this.videos.length; i++) {
                        var video = document.getElementById(this.videos[i].id);
                        var source = document.createElement('source');

                        source.setAttribute('src','video/6RXBf83aNNBjBX7xpqaK0lSxAfzZuQJbMF0K1GIQ-web.mp4');
                        source.setAttribute('type', 'video/mp4');
                        video.appendChild(source);
                    }
                }
        },
        changeUrl(type){
            if(type == 'ad') {
                var doc =  document.getElementById('gift');
                doc.style.border = "none";
                var doc =  document.getElementById('ad');
                doc.style.border = "red 2px solid";
                this.url = "/order/";
            } else {
                var doc =  document.getElementById('ad');
                doc.style.border = "none";
                var doc =  document.getElementById('gift');
                doc.style.border = "red 2px solid";
                this.url="/order-gift/";
            }
        }
    },
    components: {
        Carousel,
        Slide,
        Myvideo,

    }
}
</script>


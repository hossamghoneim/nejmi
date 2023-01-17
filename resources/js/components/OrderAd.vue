<template>
    <div>
        <div class="container-fluid" style="direction: rtl;">
            <div class="row">
                <div class="col-md-12">
                    <div class="bread">
                        <div class="container-fluid">
                            <router-link to="/">الرئيسية | </router-link>
                            <router-link :to="'/category/'+target.category.id"> {{ target.category.name }} |</router-link>
                            <router-link :to="'/user/'+target.username"> {{ target.name }} |</router-link>
                            <span> اطلب من  {{ target.name }} </span>
                        </div>
                    </div>
                    <section class="payment">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="right">
                                        <div class="heading d-flex align-items-center">
                                            <img :src="'/images/users/'+target.image" alt="" class="circle-image">
                                            <div>
                                                <h5> فاجئ احبابك بفيديو من {{ target.name }} </h5>
                                                <p>اكتب تفاصيل الطلب</p>
                                            </div>
                                        </div>
                                        <div class="form mt-4">
                                            <div v-if="form == 1 && !loading">
                                                <div class="form-row input_wrapper">
                                                    <label class="form-control-label">
                                                        رسالتك
                                                    </label>
                                                    <textarea class="form-control" cols="30" rows="10" v-model="order.message"></textarea>
                                                    <div v-if="messageRequired" class="alert alert-danger w-50 mt-2">  الرسالة اجباري </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button class="btn-custom" @click="next"> الاستمرار في الدفع </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="form == 2" >

                                                <div class="card-body">

                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <label class="form-control-label d-block">
                                                            كود الخصم
                                                            </label>

                                                            <input type="text"
                                                            class="form-control d-block w-100 "
                                                            v-model="coupon.coupon"
                                                            :disabled="coupon.discount > 0"
                                                        >
                                                        <button v-if="coupon.discount == 0"
                                                                class="btn-custom w-25 mt-2"
                                                                type="button"
                                                                @click="applyCoupon">تفعيل</button>
                                                        <button v-if="coupon.discount > 0"
                                                                class="btn btn-secondary"
                                                                type="button"
                                                                @click="cancelCoupon">إلغاء الخصم</button>
                                                        <div v-if="coupon.notValid" class="alert alert-warning mx-auto my-3 w-100">
                                                            <div>الكوبون غير صالح</div>
                                                        </div>
                                                        </div>



                                                    </div>
                                                    <hr>
                                                    <h5 v-if="coupon.discount">
                                                        قيمة الخصم:
                                                        <strong>{{ coupon.discount }}%</strong>
                                                    </h5>
                                                    <h5>
                                                        المجموع:
                                                        <strong>{{ price }} MRU</strong>
                                                    </h5>
                                                    <div class="form-group">
                                                        <label class="form-control-label">رقم الواتساب (سنرسل لك الفيديو عليه)</label>
                                                        <input type="text" class="form-control w-100" v-model="order.phone">
                                                        <div v-if="phoneRequired" class="alert alert-danger w-100 mt-2">رقم الهاتف إجباري</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <button class="btn-custom mt-2" type="button" @click="next">التالي</button>
                                                </div>
                                            </div>
                                            <div v-if="form == 3" class="card">

                                                <div class="card-body">
                                                    <h5>التحويل عبر الهاتف</h5>
                                                    <h6>2559995</h6>
                                                    <div class="form-group">
                                                        <label>صورة تثبت الدفع</label>
                                                        <input type="file" class="form-control" @change="uploadImage($event)">
                                                    </div>
                                                    <div class="steps">
                                                        <h6>بمجرد الحجز سوف تكون قد وافقت على الشروط والأحكام وسياسة الخصوصية </h6>
                                                        <div class="step">
                                                            <span>
                                                                <img src="/assets/images/check.png" alt="">
                                                            </span>
                                                            <p>
                                                                ضمان الرد على طلبك
                                                            </p>
                                                        </div>
                                                        <div class="step">
                                                            <span>
                                                                <img src="/assets/images/check.png" alt="">
                                                            </span>
                                                            <p>
                                                                ضمان استرجاع أموالك                                                            </p>
                                                        </div>
                                                        <div class="step">
                                                            <span>
                                                                <img src="/assets/images/check.png" alt="">
                                                            </span>
                                                            <p>
                                                                طلبك يصنع خصيصاً لك
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div >
                                                    <div class="alert alert-danger" v-if="errors.image_upload">يرجى رفع صورة إثبات الدفع</div>
                                                    <button
                                                        v-if="!disableBtn && order_id != null"
                                                        class="btn-custom mt-2"
                                                        type="button"
                                                        @click="next">إرسال</button>

                                                </div>
                                            </div>
                                            <div v-if="form == 4" class="card">

                                                <div class="card-body">
                                                    <h3>شكراً لك على اختيارك</h3>
                                                    <h5>سيتم معالجة طلبكم بأسرع وقت</h5>
                                                </div>
                                                <div>
                                                    <a v-if="done" class="btn btn-success mt-2" href="/">الرئيسية</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="steps">
                                        <h6>الخطوات </h6>
                                        <div class="step">
                                            <span>
                                                <img src="/assets/images/check.png" alt="">
                                            </span>
                                            <p>
                                                بعد ما تطلب الطلب، هنبعتلك
                                                رسالة بريد الكتروني للتأكيد.

                                            </p>
                                        </div>
                                        <div class="step">
                                            <span>
                                                <img src="/assets/images/check.png" alt="">
                                            </span>
                                            <p>
                                                الطلب اللي انت طلبته هيوصلك في خلال 6 أيام
                                            </p>
                                        </div>
                                        <div class="step">
                                            <span>
                                                <img src="/assets/images/check.png" alt="">
                                            </span>
                                            <p>
                                                سنرسل لك بريدًا إلكترونيًا عندما ينتهي النجم من تسجيل الفيديو، حتى يمكنك مشاهدته أو
                                                مشاركته أو تحميله عن طريق اللينك الموجود في البريد الإلكتروني.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$emit('show', false)
        let id = this.$route.params.id
        this.order.target_id = id
        axios.get("/request/get-target/" + id + "/order")
        .then((res) => {
            if(res.data == 0)
                window.location.href = "/"
            else {
                this.target = res.data
                this.price = res.data.price_ad
                this.loading = false
            }
        })
    },
    data: function () {
        return {
            auth: authUser,
            form: 1,
            order: {
                message: "",
                target_id: "",
                order_type: "ad",
                phone: "",
                mount: null,
                image: ""
            },
            coupon: {
                coupon: "",
                discount: 0,
                notValid: false
            },
            target: "",
            price: 0,
            done: false,
            loading: true,
            prev: "",
            phoneRequired: false,
            messageRequired: false,
            disableBtn: false,
            order_id: null,
            errors: {
                image_upload: false
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            vm.prev = from
        })
    },
    methods: {
        next() {

            this.phoneRequired = false
            this.messageRequired = false
            if(this.form == 1) {
                if(this.order.message == "") {
                    this.messageRequired = true;
                    return
                }
            }
            if(this.form == 2) {
                if(this.order.phone == '') {
                    this.phoneRequired = true
                    return
                }
                this.order.mount = this.price
                axios.post("/request/create-temp-order", this.order)
                .then((res) => {
                    // console.log(res.data)
                    this.order_id = res.data
                })
            }
            if(this.form == 3) {
                this.errors.image_upload = false
                if(this.order.image == "") {
                    this.errors.image_upload = true
                    return
                }
                this.disableBtn = true
                this.order.mount = this.price
                const fd = new FormData();
                // Object.entries(this.order).forEach(([key, value]) => {
                //     fd.append(key, value);
                // })
                fd.append('coupon', this.coupon.coupon)
                fd.append('image', this.order.image)
                fd.append('order_id', this.order_id)
                fd.append('target_id', this.order.target_id)

                axios({
                    method: "post",
                    url: "/request/create-order",
                    data: fd,
                    headers: {"Content-Type": "multipart/form-data"},
                })
                    .then((res) => {
                        if(res.data == 1) {


                            this.done = true
                            this.form++

                        }
                    })
            } else if(this.form == 4) {
                return
            } else {
                this.form++
            }
        },
        applyCoupon() {
            this.coupon.notValid = false
            if(this.coupon.discount > 0 || this.coupon.coupon == "") return;
            axios.get("/request/check-coupon/" + this.coupon.coupon)
            .then((res) => {
                // console.log(res.data)
                if(res.data == 0) {
                    this.coupon.discount = 0
                    this.coupon.notValid = true
                } else {
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
                        title: 'تم تفعيل الكوبون بنجاح'
                    })
                    this.coupon.discount = res.data.discount
                    this.price = (this.price) - (this.price * (this.coupon.discount / 100))
                }
            })
        },
        cancelCoupon() {
            this.coupon.coupon = ""
            this.coupon.discount = 0
            this.price = this.target.price_ad
        },
        uploadImage: function (e) {
            this.order.image = e.target.files[0]
        },
        prvious() {

        }
    }
}
</script>



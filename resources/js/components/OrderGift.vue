<template>
    <div>
        <div class="container register">
            <div class="row my-2 text-center">
                <div class="col-12">
                    <div v-if="form == 1" class="card">
                        <div class="card-header">طلب فيديو إعلاني</div>
                        <div class="card-body">
                            <div>
                                <h6>{{ target.name }}</h6>
                                <img :src="'/images/users/' + target.image" width="200">
                            </div>
                            <div class="row my-2 mb-4">
                                <div class="col-6">
                                    <p class="text-right">من:</p>
                                    <input type="text" class="form-control" v-model="order.from">
                                </div>
                                <div class="col-6">
                                    <p class="text-right">إلى:</p>
                                    <input type="text" class="form-control" v-model="order.to">
                                </div>
                            </div>
                            <div class="my-2 mb-4">
                                <p class="text-right">نوع الإهداء</p>
                                <select class="form-control" v-model="order.gift_type">
                                    <option value="تهنئة">تهنئة</option>
                                    <option value="عيد ميلاد">عيد ميلاد</option>
                                    <option value="شكر">شكر</option>
                                    <option value="إعتذار">إعتذار</option>
                                </select>
                            </div>
                            <label>رسالتك</label>
                            <textarea class="form-control" cols="30" rows="10" v-model="order.message"></textarea>
                        </div>
                        <div class="card-footer">
                            <input type="button" class="btn btn-primary" value="التالي" @click="next">
                        </div>
                    </div>
                    <div v-if="form == 2" class="card">
                        <div class="card-header">طلب فيديو إعلاني</div>
                        <div class="card-body">
                            <h6>
                                رسالتك إلى
                                <strong>{{ target.name }}</strong>
                            </h6>
                            <p v-text="order.message"></p>
                            <hr>
                            <div class="form-group">
                                <label class="d-block">كود الخصم</label>
                                <input type="text" class="form-control w-25 d-inline-block" v-model="coupon.coupon">
                                <button v-if="coupon.discount == 0"
                                        class="btn btn-info d-inline-block"
                                        type="button"
                                        @click="applyCoupon">تفعيل</button>
                                <button v-if="coupon.discount > 0"
                                        class="btn btn-secondary d-inline-block"
                                        type="button"
                                        @click="cancelCoupon">إلغاء الخصم</button>
                            </div>
                            <hr>
                            <h6>
                                المجموع:
                                <strong>{{ price }}$</strong>
                            </h6>
                            <div class="form-group text-center">
                                <label>رقم الواتساب (سنرسل لك الفيديو عليه)</label>
                                <input type="text" class="form-control w-50 mx-auto" v-model="order.phone">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success mt-2" type="button" @click="next">التالي</button>
                        </div>
                    </div>
                    <div v-if="form == 3" class="card">
                        <div class="card-header">اختر طريقة دفع</div>
                        <div class="card-body">
                            <h5>التحويل عبر الهاتف</h5>
                            <h6>2559995</h6>
                            <div class="form-group">
                                <label>صورة تثبت الدفع</label>
                                <input type="file" class="form-control" @change="uploadImage($event)">
                            </div>
                            <h6 class="text-right">بمجرد الحجز سوف تكون قد وافقت على الشروط والأحكام وسياسة الخصوصية</h6>
                            <ul class="text-right p-0">
                                <li><i class="fa fa-check"></i> ضمان الرد على طلبك</li>
                                <li><i class="fa fa-check"></i> ضمان استرجاع أموالك</li>
                                <li><i class="fa fa-check"></i> طلبك يصنع خصيصاً لك</li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <router-link v-if="done" class="btn btn-success mt-2" to="/orders">طلباتي</router-link>
                            <button v-else class="btn btn-success mt-2" type="button" @click="next">إرسال</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        if(!this.auth)
            window.location.href = "/login"
        let id = this.$route.params.id
        this.order.target_id = id
        axios.get("/request/get-target/" + id)
            .then((res) => {
                this.target = res.data
                this.price = res.data.price_ad
            })
    },
    data: function () {
        return {
            auth: authUser,
            form: 1,
            order: {
                message: "",
                target_id: "",
                order_type: "gift",
                phone: "",
                mount: null,
                image: "",
                from: "",
                to: "",
                gift_type: ""
            },
            coupon: {
                coupon: "",
                discount: 0
            },
            target: "",
            price: 0,
            done: false
        }
    },
    methods: {
        next() {
            if(this.form == 3) {
                this.order.mount = this.price
                const fd = new FormData();
                Object.entries(this.order).forEach(([key, value]) => {
                    fd.append(key, value);
                })
                fd.append('image', this.order.image)

                axios({
                    method: "post",
                    url: "/request/create-order",
                    data: fd,
                    headers: {"Content-Type": "multipart/form-data"},
                })
                    .then((res) => {
                        if(res.data == 1) {
                            this.done = true
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
                        }
                    })
            } else {
                this.form++
            }
        },
        applyCoupon() {
            if(this.coupon.discount > 0 || this.coupon.coupon == "") return;
            axios.get("/request/check-coupon/" + this.coupon.coupon)
                .then((res) => {
                    if(res.data == 0) {
                        this.coupon.discount = 0
                    } else {
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
    }
}
</script>

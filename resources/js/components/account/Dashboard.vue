<template>
    <div>
        <div class="container" style="direction:rtl; margin-top:40px;">
            <div class="row mb-5">
                <div class="col-12 text-center mb-3">
                    <h4>لوحة التحكم</h4>
                </div>
                <div class="col-12 col-md-3">
                    <div class="dashboard-menu">
                        <ul>
                            <li class="active">
                                <router-link class="reg" to="/dashboard">

                                    <label  id="dashboard_label" style="padding-right: 3rem;">لوحة التحكم</label>
                                </router-link>
                            </li>
                            <li v-if="auth.type == 1">
                                <router-link class="reg" to="/videos">

                                    <label  id="dashboard_label" style="padding-right: 3rem;">الفيديوهات</label>
                                </router-link>
                            </li>
                            <li>
                                <router-link class="reg" to="/orders">

                                    <label  id="dashboard_label" style="padding-right: 4.4rem;">طلباتي</label>
                                </router-link>
                            </li>
                            <li v-if="auth.type == 1">
                                <router-link class="reg" to="/logs">

                                    <label  id="dashboard_label" style="padding-right: 4.4rem;">السجل</label>
                                </router-link>
                            </li>
                            <li v-if="auth.type == 0">
                                <router-link class="reg" to="/alerts">

                                    <label  id="dashboard_label" style="padding-right: 4.4rem;">التنبيهات</label>
                                </router-link>
                            </li>
                            <li>
                                <router-link class="reg" to="/account">

                                    <label id="dashboard_label" style="padding-right: 4.4rem;">بياناتي</label>
                                </router-link>
                            </li>
                            <li>
                                <a class="reg" href="/logout">

                                    <label  id="dashboard_label" style="padding-right: 2rem;">تسجيل الخروج</label>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="stats">
                        <div class="row">
                            <div class="col-12 col-md-4" v-if="auth.type == 1">
                                <div class="box blue">

                                    <router-link to="/videos">إضافة فيديو</router-link>
                                </div>
                            </div>
                            <div class="col-12 col-md-4" v-if="auth.type ==0">
                                <div class="box blue">

                                    <router-link to="/orders">طلباتي</router-link>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="box green">

                                    <router-link to="/account">تعديل بياناتي</router-link>
                                </div>
                            </div>
                            <div class="col-12 col-md-4" v-if="auth.type == 1">
                                <div class="box orange">

                                    <router-link :to="'/user/'+auth.username">معاينة ملفي الشخصي</router-link>
                                </div>
                            </div>
                            <div class="col-12 my-4" v-if="auth.type == 1">
                                <h3>استقبال الطلبات</h3>
                                <div class="form-group mt-3">
                                    <input type="checkbox"
                                           id="accept_orders"
                                           v-model="acceptOrders"
                                           @change="toggleAcceptOrders('orders')"
                                    >
                                    <label for="accept_orders">السماح باستقبال الطلبات</label>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="checkbox"
                                           id="accept_gifts"
                                           v-model="acceptGifts"
                                           @change="toggleAcceptOrders('gifts')"
                                    >
                                    <label for="accept_gifts">السماح باستقبال طلبات الإهداء</label>
                                </div>
                            </div>
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
        this.$emit('active', '')
        this.acceptOrders = authUser.accept_orders
        this.acceptGifts = authUser.accept_gifts
    },
    data: function () {
        return {
            auth: authUser,
            acceptOrders: null,
            acceptGifts: null
        }
    },
    methods: {
        toggleAcceptOrders(t) {
            axios.post("/request/toggle-accept-orders", {
                accept_orders: this.acceptOrders,
                accept_gifts: this.acceptGifts,
                type: t
            })
                .then((res) => {
                    if(res.status == 200) {
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
                            title: res.data
                        })
                    }
                })
        }
    }
}
</script>

<style>
.dashboard-menu ul {
    margin: 0;
    padding: 0;
}
.dashboard-menu ul li {
    margin: 10px 0;
}
.dashboard-menu ul li a {
    display: block;
    width: 100%;
    padding: 10px;
    border-bottom: 1px solid #eee;
}
.dashboard-menu ul li.active a {
    color: #25D366 !important;
}
.stats .box {
    color: #fff;
    padding: 12px;
    border-radius: 7px;
    height: 100px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    font-size: 20px;
    margin: 10px 0;
}
.stats .box a {
    color: #fff
}
.stats .box.blue {
    background: #5d67f4;
}
.stats .box.green {
    background: #2dce1f;
}
.stats .box.orange {
    background: #ff6000;
}
</style>

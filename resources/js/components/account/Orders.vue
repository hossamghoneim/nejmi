<template>
    <div>
        <div class="container" style="direction:rtl; margin-top:40px">
            <div class="row mb-5">
                <div class="col-12 text-center mb-3">
                    <h4>لوحة التحكم</h4>
                </div>
                <div class="col-12 col-md-3">
                    <div class="dashboard-menu">
                        <ul>
                            <li>
                                <router-link to="/dashboard">

                                    لوحة التحكم
                                </router-link>
                            </li>
                            <li v-if="auth.type == 1">
                                <router-link to="/videos">

                                    الفيديوهات
                                </router-link>
                            </li>
                            <li class="active">
                                <router-link to="/orders">

                                    طلباتي
                                </router-link>
                            </li>
                            <li v-if="auth.type == 1">
                                <router-link to="/logs">

                                    السجل
                                </router-link>
                            </li>
                            <li v-if="auth.type == 0">
                                <router-link to="/alerts">

                                    التنبيهات
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/account">

                                    بياناتي
                                </router-link>
                            </li>
                            <li>
                                <a href="/logout">

                                    تسجيل الخروج
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                            <h6 class="m-0 font-weight-bold text-primary">
                                طلباتي
                            </h6>
                        </div>
                        <div class="card-body" v-if="auth.type == 0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>المشهور</th>
                                                <th>قيمة الطلب</th>
                                                <th>نوع الطلب</th>
                                                <th>حالة الطلب</th>
                                                <th>تاريخ الطلب</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(order, index) in orders" :key="index">
                                                <td>
                                                    <router-link :to="'/user/' + order.freelancer.username">{{ order.freelancer.name }}</router-link>
                                                </td>
                                                <td>{{ order.mount }} MRU</td>
                                                <td>{{ order.type == 'ad' ? 'إهداء' : 'إعلان' }}</td>
                                                <td v-if="order.status == 1">
                                                    <div class="badge badge-success">مقبول</div>
                                                </td>
                                                <td v-else-if="order.status == 0">
                                                    <div class="badge badge-secondary">قيد المراجعة</div>
                                                </td>
                                                <td v-else>
                                                    <div class="badge badge-danger">مرفوض</div>
                                                </td>
                                                <td>{{ order.time }}</td>
                                            </tr>
                                            <tr class="text-center" v-if="orders.length == 0">
                                                <td colspan="5">لايوجد طلبات.</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" v-if="auth.type == 1">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="mb-3">الإحصائيات</h5>
                                    <div class="row text-center">
                                        <div class="col-12 col-md-4 my-3">
                                            <h5>إجمالي أرباحي</h5>
                                            <h6>{{ total_sales }} MRU</h6>
                                        </div>
                                        <div class="col-12 col-md-4 my-3">
                                            <h5>استلمتها</h5>
                                            <h6>{{ done_orders_mount }} MRU</h6>
                                        </div>
                                        <div class="col-12 col-md-4 my-3">
                                            <h5>معلقة</h5>
                                            <h6>{{ total_sales - done_orders_mount }} MRU</h6>
                                        </div>
                                    </div>
                                    <h5 class="mb-3">الطلبات</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>المشتري</th>
                                                <th>قيمة الطلب (أرباحي)</th>
                                                <th>نوع الطلب</th>
                                                <th>حالة الطلب</th>
                                                <th>تاريخ الطلب</th>
                                                <th>رسالة المشتري</th>
                                                <th>خيارت</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(order, index) in orders" :key="index">
                                                <td>
                                                    <p v-if="order.user">
                                                        {{ order.user.name }}
                                                    </p>
                                                    <p v-else>غير مسجل</p>
                                                </td>
                                                <td>{{ order.mount - (order.mount * order.commission / 100) }} MRU</td>
                                                <td>{{ order.type == 'ad' ? 'إهداء' : 'إعلان' }}</td>
                                                <td v-if="order.status == 1">
                                                    <div class="badge badge-success p-1">مقبول</div>
                                                    <div v-if="order.done" class="badge badge-success p-1">تم تسليم الأربح</div>
                                                </td>
                                                <td v-else-if="order.status == 0">
                                                    <div class="badge badge-secondary">قيد المراجعة</div>
                                                </td>
                                                <td v-else>
                                                    <div class="badge badge-danger p-1">مرفوض</div>
                                                </td>
                                                <td>{{ order.time }}</td>
                                                <td>{{ order.message }}</td>
                                                <td>
                                                    <button
                                                        v-if="order.done != 1 && (order.status == 0 || order.status == -1)"
                                                        @click="toggleOrderStatus(order.id,1)"
                                                        class="btn btn-success btn-sm mb-1">
                                                        قبول
                                                    </button>
                                                    <button
                                                        v-if="order.done != 1 && (order.status == 0 || order.status == 1)"
                                                        @click="toggleOrderStatus(order.id,-1)"
                                                        class="btn btn-danger btn-sm">
                                                        رفض
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="text-center" v-if="orders.length == 0">
                                                <td colspan="7">لايوجد طلبات.</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
        if(authUser) {
            axios.get("/request/get-user-orders")
                .then((res) => {
                    if(authUser.type == 0) {
                        this.orders = res.data
                    } else {
                        this.orders = res.data.orders
                        this.total_sales = res.data.total_sales
                        this.done_orders_mount = res.data.done_orders_mount
                    }
                })
        } else {
         window.location.href = "/login"
        }
    },
    data: function () {
        return {
            auth: authUser,
            orders: [],
            total_sales: null,
            done_orders_mount: null,
        }
    },
    methods: {
        toggleOrderStatus(id, s) {
            axios.post("/request/toggle-order-status", {
                order_id: id,
                status: s
            })
            .then((res) => {
                if(res.status == 200) {
                    this.orders.find((el) => {
                        if(el.id == res.data.id)
                            el.status = res.data.status
                    })
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
                        title: 'تم التعديل بنجاح'
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
    color: blue;
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

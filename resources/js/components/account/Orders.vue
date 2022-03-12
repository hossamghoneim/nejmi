<template>
    <div>
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center mb-3">
                    <h4>لوحة التحكم</h4>
                </div>
                <div class="col-12 col-md-3">
                    <div class="dashboard-menu">
                        <ul>
                            <li>
                                <router-link to="/dashboard">
                                    <i class="fa fa-home"></i>
                                    لوحة التحكم
                                </router-link>
                            </li>
                            <li v-if="auth.type == 1">
                                <router-link to="/videos">
                                    <i class="fa fa-video"></i>
                                    الفيديوهات
                                </router-link>
                            </li>
                            <li v-if="auth.type == 0" class="active">
                                <router-link to="/orders">
                                    <i class="fa fa-bars"></i>
                                    طلباتي
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/account">
                                    <i class="fa fa-id-card-alt"></i>
                                    بياناتي
                                </router-link>
                            </li>
                            <li>
                                <a href="/logout">
                                    <i class="fa fa-sign-out-alt"></i>
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
                        <div class="card-body">
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
                                                    <router-link :to="'/user/' + order.freelancer.id">{{ order.freelancer.name }}</router-link>
                                                </td>
                                                <td>{{ order.mount }}$</td>
                                                <td>{{ order.type == 'ad' ? 'إعلان' : 'إهداء' }}</td>
                                                <td v-if="order.status == 1">مقبول</td>
                                                <td v-else-if="order.status == 0">قيد المراجعة</td>
                                                <td v-else>مرفوض</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        axios.get("/request/get-user-orders")
        .then((res) => {
            this.orders = res.data
        })
    },
    data: function () {
        return {
            auth: authUser,
            orders: []
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

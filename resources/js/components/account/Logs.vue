<template>
    <div>
        <div class="container" style="direction:rtl; margin-top:40px">
            <div class="row mb-5">
                <div class="col-12 text-center mb-3">
                    <h4>السجل</h4>
                </div>
                <div class="col-12 col-md-3">
                    <div class="dashboard-menu">
                        <ul>
                            <li>
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
                            <li class="active" v-if="auth.type == 1">
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                            <h6 class="m-0 font-weight-bold text-primary">
                                سجل الدفع
                            </h6>
                        </div>
                        <div class="card-body" v-if="auth.type == 1">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="mb-3">سجل الدفع</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>رقم الطلب</th>
                                                <th>قيمة الطلب</th>
                                                <th>تاريخ التسليم</th>
                                                <th>ملاحظات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(log, index) in logs" :key="index">
                                                <td>{{ log.order_id }}</td>
                                                <td>{{ log.mount }} MRU</td>
                                                <td>{{ log.time }}</td>
                                                <td>{{ log.notes ? log.notes : '-' }}</td>
                                            </tr>
                                            <tr class="text-center" v-if="logs.length == 0">
                                                <td colspan="5">لايوجد سجل.</td>
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
        if(authUser && authUser.type == 1) {
            axios.get("/request/get-user-logs")
                .then((res) => {
                    this.logs = res.data
                })
        } else {
            window.location.href = "/login"
        }
    },
    data: function () {
        return {
            auth: authUser,
            logs: [],
        }
    },
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

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
                            <li class="active">
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
                            <li v-if="auth.type == 0">
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
                    <div class="stats">
                        <div class="row">
                            <div class="col-12 col-md-4" v-if="auth.type == 1">
                                <div class="box blue">
                                    <i class="fa fa-video"></i>
                                    <router-link to="/videos">إضافة فيديو</router-link>
                                </div>
                            </div>
                            <div class="col-12 col-md-4" v-if="auth.type ==0">
                                <div class="box blue">
                                    <i class="fa fa-bars"></i>
                                    <router-link to="/orders">طلباتي</router-link>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="box green">
                                    <i class="fa fa-edit"></i>
                                    <router-link to="/account">تعديل بياناتي</router-link>
                                </div>
                            </div>
                            <div class="col-12 col-md-4" v-if="auth.type == 1">
                                <div class="box orange">
                                    <i class="fa fa-eye"></i>
                                    <router-link :to="'/user/'+auth.id">معاينة ملفي الشخصي</router-link>
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
    data: function () {
        return {
            auth: authUser,
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

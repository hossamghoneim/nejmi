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
                            <li v-if="auth.type == 0">
                                <router-link to="/orders">
                                    <i class="fa fa-bars"></i>
                                    طلباتي
                                </router-link>
                            </li>
                            <li class="active">
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
                    <div class="account-wrap">
                        <h5 class="my-4">بياناتي الأساسية</h5>
                        <div class="form-group">
                            <label>الاسم الكامل</label>
                            <input type="text"
                                   class="form-control"
                                   v-model="data.name"
                                   :placeholder="user.name">
                        </div>
                        <div class="form-group" v-if="user.type == 1">
                            <label>عدد المتابعين</label>
                            <input type="number"
                                   class="form-control"
                                   v-model="data.followers"
                                   :placeholder="user.followers">
                        </div>
                        <div class="form-group" v-if="user.type == 1">
                            <label>وصف قصير عن نفسك</label>
                            <textarea class="form-control" cols="30" rows="10" v-model="data.about" :placeholder="user.about"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-success" @click="update('info')">حفظ</button>
                        </div>
                    </div>
                    <div class="account-wrap">
                        <h5>تغيير كلمة المرور</h5>
                        <div class="form-group">
                            <label>كلمة المرور الجديدة</label>
                            <input type="password" class="form-control" v-model="data.password">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-success" @click="update('password')">حفظ</button>
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
            user: authUser,
            data: {
                name: "",
                followers: "",
                about: "",
                password: ""
            }
        }
    },
    methods: {
        update(t) {
            if (t == 'info') {
                axios.post('/request/update-account', {
                    data: this.data
                })
                    .then((res) => {
                        console.log(res.data)
                    })
            } else if (t == 'password') {
                axios.post('/request/update-password', {
                    data: this.data
                })
                    .then((res) => {
                        console.log(res.data)
                    })
            }
        }
    }
}
</script>

<style>
.account-wrap {
    border: 1px solid #eee;
    padding: 15px;
    border-radius: 10px;
    margin: 20px 0
}
</style>

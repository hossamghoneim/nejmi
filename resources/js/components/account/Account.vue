<style>
    #dashboard_label{
        color: white;
    }
    ul {
        list-style-type: none;
    }
</style>
<template>
    <div>
        <div class="container" dir="rtl" style="direction:rtl; text-align:right; margin-top:40px">
            <div class="row mb-5">
                <div class="col-12 text-center mb-3">
                    <h4>لوحة التحكم</h4>
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
                            <li class="active">
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
                    <div class="account-wrap" v-if="auth.type == 1">
                        <div class="form-group">
                            <label>الصورة الشخصية</label>
                            <input type="file" class="form-control" @change="uploadImage($event)">
                            <div class="form-group mt-3" v-if="previewImage">
                                <img :src="previewImage" class="w-100">
                                <div class="text-center my-3">
                                    <button type="button"
                                            class="btn btn-danger"
                                            @click="clearImage">
                                        <i class="fa fa-trash-alt"></i>
                                        حذف الصورة
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>الفيديو الأساسي</label>
                            <input type="file" class="form-control" @change="uploadVideo($event)">
                            <div class="form-group mt-3" v-if="previewVideo">
                                <video :src="previewVideo" class="w-100" height="auto" controls>
                                    <source :src="previewVideo" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="text-center my-3">
                                    <button type="button"
                                            class="btn btn-danger"
                                            @click="clearVideo">
                                        <i class="fa fa-trash-alt"></i>
                                        حذف الفيديو
                                    </button>
                                </div>
                            </div>
                            <p v-if="upload" class="mt-3">يتم رفع الفيديو لا تخرج من الصفحة حتى إكتمال العملية...</p>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-success" @click="update('image')">حفظ</button>
                        </div>
                    </div>
                    <div class="account-wrap">
                        <h5 class="my-4">بياناتي الأساسية</h5>
                        <div class="form-group">
                            <label>الاسم الكامل</label>
                            <input type="text"
                                   class="form-control"
                                   v-model="data.name"
                                   :placeholder="user.name">
                        </div>
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="text"
                                   class="form-control"
                                   v-model="data.phone"
                                   :placeholder="user.phone">
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
    mounted() {
        this.data = this.auth
    },
    data: function () {
        return {
            auth: authUser,
            user: authUser,
            data: {
                name: "",
                followers: "",
                about: "",
                password: "",
                image: "",
                video: "",
                phone: ""
            },
            upload: false,
            previewImage: "",
            previewVideo: ""
        }
    },
    methods: {
        update(t) {
            if (t == 'info') {
                axios.post('/request/update-account', {
                    data: this.data
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
                                title: 'تم التعديل بنجاح'
                            })
                        }
                    })
            } else if (t == 'password') {
                axios.post('/request/update-password', {
                    data: this.data
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
                                title: 'تم التعديل بنجاح'
                            })
                        }
                    })
            } else if (t == 'image') {
                if(this.data.video)
                    this.upload = true
                const fd = new FormData();
                Object.entries(this.data).forEach(([key, value]) => {
                    fd.append(key, value);
                })
                fd.append('image', this.data.image)
                fd.append('video', this.data.video)

                axios({
                    method: "post",
                    url: "/request/update-image-video",
                    data: fd,
                    headers: {"Content-Type": "multipart/form-data"},
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
                            title: 'تم التعديل بنجاح'
                        })
                        this.upload = false
                    }
                })
            }
        },
        uploadImage: function (e) {
            this.previewImage = URL.createObjectURL(e.target.files[0])
            this.data.image = e.target.files[0]
        },
        uploadVideo: function (e) {
            this.previewVideo = URL.createObjectURL(e.target.files[0])
            this.data.video = e.target.files[0]
        },
        clearImage() {
            this.previewImage = ""
            this.data.image = ""
        },
        clearVideo() {
            this.previewVideo = ""
            this.data.video = ""
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

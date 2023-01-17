<template>
    <div>
        <div class="container" style="direction:rtl">
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
                            <li>
                                <router-link to="/orders">
                                    <i class="fa fa-bars"></i>
                                    طلباتي
                                </router-link>
                            </li>
                            <li v-if="auth.type == 1">
                                <router-link to="/logs">
                                    <i class="fa fa-file-alt"></i>
                                    السجل
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
                    <div class="account-wrap" v-if="activated == 0 || activated == -1">
                        <div class="alert alert-warning" v-if="activated == -1">تم رفض التوثيق الذي أرسلته، يمكنك رفع توثيق جديد.</div>
                        <div class="form-group">
                            <label>نوع الوثيقة</label>
                            <select class="form-control" v-model="data.image_type">
                                <option value="هوية شخصية">هوية شخصية</option>
                                <option value="جواز سفر">جواز سفر</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>صورة الوثيقة</label>
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
                            <button v-if="!sent" type="button" class="btn btn-success" @click="send">إرسال</button>
                        </div>
                    </div>
                    <div class="account-wrap" v-if="activated == 1">
                        <div class="alert alert-success">حسابك موثق.</div>
                    </div>
                    <div class="account-wrap" v-if="activated == 2">
                        <div class="alert alert-info">تم إرسال التوثيق بانتظار مراجعة الإدارة.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        axios.get("/request/get-user-activation")
        .then((res) => {
            if(res.data == -2)
                window.location.href = "/"
            this.activated = res.data
        })
    },
    data: function () {
        return {
            auth: authUser,
            previewImage: "",
            data: {
                image: "",
                image_type: "",
                status: null
            },
            activated: null,
            sent: false
        }
    },
    methods: {
        send() {
          if(this.data.image != '' && this.data.image_type != '') {
              const fd = new FormData();
              Object.entries(this.data).forEach(([key, value]) => {
                  fd.append(key, value);
              })
              fd.append('image', this.data.image)
              axios({
                  method: "post",
                  url: "/request/send-activation",
                  data: fd,
                  headers: {"Content-Type": "multipart/form-data"},
              })
              .then((res) => {
                  this.sent = true
                  this.previewImage = ""
                  this.data.image = ""
                  this.activated = 2
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
                      title: 'تم إرسال توثيق بنجاح، ستتم مراجعته من قبل الإدارة'
                  })
              })
          }
        },
        uploadImage: function (e) {
            this.previewImage = URL.createObjectURL(e.target.files[0])
            this.data.image = e.target.files[0]
        },
        clearImage() {
            this.previewImage = ""
            this.data.image = ""
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

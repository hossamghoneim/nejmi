<template>
    <div>
        <div class="container" style="direction:rtl; margin-top: 40px;">
            <div class="row mb-5">
                <div class="col-12 text-center mb-3">
                    <h4>الفيديوهات</h4>
                </div>
                <div class="col-12 col-md-3">
                    <div class="dashboard-menu">
                        <ul>
                            <li>
                                <router-link class="reg" to="/dashboard">

                                    <label  id="dashboard_label" style="padding-right: 3rem;">لوحة التحكم</label>
                                </router-link>
                            </li>
                            <li class="active" v-if="auth.type == 1">
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
                    <div class="account-wrap">
                        <button type="button" class="btn btn-primary" @click="newVideoSection = !newVideoSection">فيديو
                            جديد
                        </button>
                        <div class="add-video" v-if="newVideoSection">
                            <input type="file" class="form-control" @change="uploadVideo($event)">
                            <div class="form-group" v-if="preview">
                                <video :src="preview" class="w-100" height="auto" controls>
                                    <source :src="preview" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="text-center my-3">
                                    <button type="button"
                                            class="btn btn-danger"
                                            @click="clearFile">
                                        <i class="fa fa-trash-alt"></i>
                                        حذف الفيديو
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mt-2" @click="add">إضافة</button>
                            <p v-if="upload" class="mt-3">يتم رفع الفيديو لا تخرج من الصفحة حتى إكتمال العملية...</p>
                        </div>
                        <div class="videos my-4">
                            <h4>فيديوهاتي</h4>
                            <div class="row" v-if="videos.length">
                                <div class="col-12 col-md-6 text-center"
                                     v-for="(video, index) in videos"
                                     :key="index">
                                    <video :src="'/video/' + video.video" class="w-100" height="400" controls>
                                        <source :src="'/video/' + video.video" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <button class="btn btn-danger" @click="deleteVideo(index)">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row" v-else>
                                <div class="col-12 text-center">
                                    <p>لا يوجد فيديوهات.</p>
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
        axios.get('/request/get-videos')
        .then((res) => {
            this.videos = res.data
        })
    },
    data: function () {
        return {
            auth: authUser,
            videos: [],
            newVideoSection: false,
            newVideo: "",
            upload: false,
            preview: ""
        }
    },
    methods: {
        add() {
            if(this.newVideo == "")
                return
            this.upload = true
            const fd = new FormData();
            Object.entries(this.newVideo).forEach(([key, value]) => {
                fd.append(key, value);
            })
            fd.append('video', this.newVideo)

            axios({
                method: "post",
                url: "/request/add-video",
                data: fd,
                headers: {"Content-Type": "multipart/form-data"},
            })
                .then((res) => {
                    this.newVideo = ""
                    this.videos.unshift(res.data)
                    this.upload = false
                })
        },
        uploadVideo: function (e) {
            this.preview = URL.createObjectURL(e.target.files[0])
            this.newVideo = e.target.files[0]
        },
        deleteVideo(index) {
            axios.post("/request/delete-video", {
                id: this.videos[index].id
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
                        title: 'تم الحذف بنجاح'
                    })
                }
            })
        },
        clearFile() {
            this.preview = ""
            this.newVideo = ""
        }
    }
}
</script>

<style scoped>
.add-video {
    margin: 45px 0;
}
video {
    border: 1px solid #eee;
    margin-top: 15px;
}
</style>

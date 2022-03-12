<template>
    <div>
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center mb-3">
                    <h4>لوحة التحكم - الفيديوهات</h4>
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
                            <li class="active" v-if="auth.type == 1">
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
                    <div class="account-wrap">
                        <button type="button" class="btn btn-primary" @click="newVideoSection = !newVideoSection">فيديو
                            جديد
                        </button>
                        <div class="add-video" v-if="newVideoSection">
                            <input type="file" class="form-control" @change="uploadVideo($event)">
                            <button type="button" class="btn btn-success mt-2" @click="add">إضافة</button>
                            <p v-if="upload" class="mt-3">يتم رفع الفيديو لا تخرج من الصفحة حتى إكتمال العملية...</p>
                        </div>
                        <div class="videos my-4">
                            <h4>فيديوهاتي</h4>
                            <div class="row" v-if="videos.length">
                                <div class="col-12 col-md-6" v-for="video in videos" :key="video.id">
                                    <video :src="'/videos/' + video.video" class="w-100" height="400" controls>
                                        <source :src="'/videos/' + video.video" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
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
            this.newVideo = e.target.files[0]
        },
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

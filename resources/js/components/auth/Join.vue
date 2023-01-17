<template>
    <div>
        <div class="container register" style="margin-top:50px">
            <div class="row my-2 ">
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <form action="" method="post">
                        <div class="form-group">
                            <label>الاسم الكامل</label>
                            <input type="text" class="form-control" v-model="user.name">
                        </div>
                        <div class="form-group">
                            <label>أسم المستخدم</label>
                            <input type="text" class="form-control" v-model="user.username">
                        </div>
                        <div class="form-group">
                            <label>رقم الهاتف (واتساب)</label>
                            <input type="text" class="form-control" v-model="user.phone">
                        </div>
                        <div class="form-group">
                            <label>عدد المتابعين</label>
                            <input type="number" class="form-control" v-model="user.followers">
                        </div>
                        <div class="form-group">
                            <label>القسم</label>
                            <select class="form-control" v-model="user.category_id">
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>البلد</label>
                            <select class="form-control" v-model="user.country_id">
                                <option v-for="country in countries" :key="country.id" :value="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>سعر الإعلان (MRU)</label>
                            <input type="number" class="form-control" v-model="user.price_ad">
                        </div>
                        <div class="form-group">
                            <label>سعر الإهداء (MRU)</label>
                            <input type="number" class="form-control" v-model="user.price_gift">
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password" autocomplete="off" class="form-control" v-model="user.password">
                        </div>
                        <div class="form-group">
                            <label>وصف قصير عن نفسك</label>
                            <textarea class="form-control" cols="30" rows="10" v-model="user.about"></textarea>
                        </div>
                        <div class="form-group">
                            <label>فيديو لك</label>
                            <input type="file" class="form-control" @change="uploadVideo($event)">
                            <p v-if="upload" class="mt-3">يتم رفع الفيديو لا تخرج من الصفحة حتى إكتمال العملية...</p>
                        </div>
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
                        <hr>
                        <div class="form-group" v-if="errorMessage">
                            <div class="alert alert-danger">{{ errorMessage }}</div>
                        </div>
                        <div class="form-group text-center">
                            <input type="button" class="btn btn-custom" value="تسجيل" @click="register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$emit('active', '')
        axios.get('/request/get-categories')
            .then((res) => {
                this.categories = res.data
            })
            axios.get('/request/get-countries')
            .then((res) => {
                this.countries = res.data

            })
    },
    data: function () {
        return {
            categories: [],
            countries : [],
            user: {
                name: "",
                username: "",
                password: "",
                phone: "",
                category_id: "",
                price_ad: "",
                price_gift: "",
                followers: "",
                about: "",
                video: "",
                type: 1,
            },
            upload: false,
            errorMessage: "",
            preview: ""
        }
    },
    methods: {
        register() {
            this.errorMessage = ""

            if (this.user.video)
                this.upload = true
            const fd = new FormData();
            Object.entries(this.user).forEach(([key, value]) => {
                fd.append(key, value);
            })
            fd.append('video', this.user.video)

            axios({
                method: "post",
                url: "/request/register",
                data: fd,
                headers: {"Content-Type": "multipart/form-data"},
            })
                .then((res) => {
                    window.location.href = "/account"
                })
                .catch((error) => {
                    if (error.response.status == 409) {
                        this.errorMessage = error.response.data
                    }
                })
        },
        uploadVideo: function (e) {
            this.preview = URL.createObjectURL(e.target.files[0])
            this.user.video = e.target.files[0]
        },
        clearFile() {
            this.preview = ""
            this.user.video = ""
        }
    }
}
</script>

<style scoped>
.account-type {
    width: 120px;
    height: 100px;
    background-color: #f5f5f5;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border-radius: 7px;
    margin: 0 10px;
    position: relative;
    cursor: pointer;
}

.account-type span {

}

.account-type i {
    font-size: 22px;
}

.account-type.selected {
    border: 2px solid #a4a4a4;
}
</style>

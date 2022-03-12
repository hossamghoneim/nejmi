<template>
    <div>
        <div class="container register">
            <div class="row my-2 text-center">
                <div class="col-12">
                    <h4>تسجيل حساب مشهور</h4>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>الاسم الكامل</label>
                            <input type="text" class="form-control" v-model="user.name">
                        </div>
                        <div class="form-group">
                            <label>البلد</label>
                            <select class="form-control" v-model="user.country_id">
                                <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                            </select>
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
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>سعر الإعلان ($)</label>
                            <input type="number" class="form-control" v-model="user.price_ad">
                        </div>
                        <div class="form-group">
                            <label>سعر الإهداء ($)</label>
                            <input type="number" class="form-control" v-model="user.price_gift">
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password" class="form-control" v-model="user.password">
                        </div>
                        <div class="form-group">
                            <label>وصف قصير عن نفسك</label>
                            <textarea class="form-control" cols="30" rows="10" v-model="user.about"></textarea>
                        </div>
                        <div class="form-group">
                            <label>صورتك الشخصية</label>
                            <input type="file" class="form-control" @change="uploadImage($event)">
                        </div>
                        <div class="form-group text-center">
                            <input type="button" class="btn btn-primary" value="تسجيل" @click="register">
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
        axios.get('/request/get-countries')
            .then((res) => {
                this.countries = res.data
            })
        axios.get('/request/get-categories')
            .then((res) => {
                this.categories = res.data
            })
    },
    data: function () {
        return {
            countries: [],
            categories: [],
            user: {
                name: "",
                password: "",
                phone: "",
                country_id: "",
                category_id: "",
                price_ad: "",
                price_gift: "",
                followers: "",
                about: "",
                image: "",
                type: 1,
            }
        }
    },
    methods: {
        register() {
            const fd = new FormData();
            Object.entries(this.user).forEach(([key, value]) => {
                fd.append(key, value);
            })
            fd.append('image', this.user.image)

            axios({
                method: "post",
                url: "/request/register",
                data: fd,
                headers: {"Content-Type": "multipart/form-data"},
            })
                .then((res) => {
                    window.location.href = "/"
                })
        },
        uploadImage: function (e) {
            this.user.image = e.target.files[0]
        },
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

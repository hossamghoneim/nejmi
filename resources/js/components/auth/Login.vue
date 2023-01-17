<template>
    <div dir="rtl" class="mt-4" style="margin-top:50px">
        <div class="container login">
            <div class="row my-2">
                <div class="col-md-4"></div>
                <div class="col-md-4 card" style="padding:10px">

                    <form action="" method="post">
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="text" class="form-control" v-model="phone">
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password" class="form-control" v-model="password">
                        </div>
                        <div class="alert alert-danger" v-if="errors.invalid">البيانات غير صحيحة</div>
                        <div class="form-group text-right">
                            <a href="/forget-password">هل نسيت كلمة المرور؟</a>
                        </div>
                        <div class="form-group text-center">
                            <input type="button" class="btn btn-custom" value="دخول" @click="login">
                        </div>
                    </form>
                    <h4 class="text-center mt-2"> <strong>أو يمكنك</strong> </h4>
                    <router-link to="/register" class="btn btn-custom-outline my-2">إنشاء حساب جديد</router-link>
                    <br>
                    <router-link to="/join" class="my-2 btn btn-custom-outline ">إنضم إلينا كمشهور</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$emit('active', '')
    },
    data: function () {
        return {
            phone: "",
            password: "",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: {
                invalid: false
            }
        }
    },
    methods: {
        login() {
            axios.post('/request/login', {
                phone: this.phone,
                password: this.password,
                _token: this.csrf
            })
            .then((res) => {
                if(res.data == 0) {
                    this.errors.invalid = true
                } else
                    window.location.href = "/"
            })
        }
    }
}
</script>

<style scoped>

</style>

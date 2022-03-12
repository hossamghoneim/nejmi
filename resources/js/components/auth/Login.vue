<template>
    <div class="mb-4">
        <div class="container login">
            <div class="row my-2 text-center">
                <div class="col-12">
                    <h4>تسجيل الدخول</h4>
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
                        <div class="form-group text-center">
                            <input type="button" class="btn btn-primary" value="دخول" @click="login">
                        </div>
                    </form>
                    <h6>أو يمكنك</h6>
                    <router-link to="/register" class="my-2">إنشاء حساب جديد</router-link>
                    <br>
                    <router-link to="/join" class="my-2">إنضم إلينا كمشهور</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
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

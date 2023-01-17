<template>
    <div class="mb-4">
        <div class="container login">
            <div class="row my-2 text-center">
                <div class="col-12">
                    <h4>نسيت كلمة المرور</h4>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="email" class="form-control" v-model="email">
                        </div>
                        <div class="alert alert-danger" v-if="errors.empty">البريد الإلكتروني إجباري</div>
                        <div class="alert alert-danger" v-if="errors.invalid">البريد الإلكتروني غير موجود</div>
                        <div class="form-group text-center">
                            <input type="button" class="btn btn-primary" value="إرسال">
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
    },
    data: function () {
        return {
            email: "",
            errors: {
                empty: false,
                invalidEmail: false
            }
        }
    },
    methods: {
        send() {
            axios.post("/forgot-password", {
                email: this.email
            })
            .then((res) => {
                console.log(res.data)
            })
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div>
        <div class="container register " style="margin-top:50px">
            <div class="row my-2">
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <form action="" method="post">
                        <div class="form-group">
                            <label>الاسم الكامل</label>
                            <input type="text" class="form-control" v-model="user.name">
                        </div>
                        <div class="form-group">
                            <label>رقم الهاتف (واتساب)</label>
                            <input type="text" class="form-control" v-model="user.phone">
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password" autocomplete="off" class="form-control" v-model="user.password">
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
    },
    data: function () {
        return {
            user: {
                name: "",
                password: "",
                phone: "",
                type: 0,
            }
        }
    },
    methods: {
        register() {
            const fd = new FormData();
            Object.entries(this.user).forEach(([key, value]) => {
                fd.append(key, value);
            })

            axios({
                method: "post",
                url: "/request/register",
                data: fd,
                headers: {"Content-Type": "multipart/form-data"},
            })
            .then((res) => {
                window.location.href = "/account"
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

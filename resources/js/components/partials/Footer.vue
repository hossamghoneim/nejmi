<template>
    <footer>
        <div class="container-fluid">
            <div class="d-flex footer_links align-items-center justify-content-center">
                <router-link to="/contact-us">
                    اتصل بنا
                </router-link>
                <router-link to="/terms-conditions">
                    شروط الاستخدام
                </router-link>
                <router-link to="/join">
                    انضم كنجم
                </router-link>

            </div>
        </div>
    </footer>
</template>

<script>
export default {
    mounted() {
        axios.get('/request/get-pages')
        .then((res) => {
            if(res.status == 200)
                this.pages = res.data
        })
    },
    data: function () {
        return {
            pages: []
        }
    }
}
</script>

<style scoped>

</style>

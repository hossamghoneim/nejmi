<template>
    <div class="container">
        <div class="row" v-if="page">
            <div class="col-12">
                <h1 class="text-center">{{ page.name }}</h1>
                <div>
                    <p v-html="page.body"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$emit('active', '')
        let slug = this.$route.params.slug
        axios.get('/request/get-page/' + slug)
        .then((res) => {
            if(res.status == 200)
                this.page = res.data
        })
        .catch((error) => {
            if(error.response.status == 404)
                window.location.href = "/"
        })
    },
    data: function () {
        return {
            page: null
        }
    }
}
</script>

<style scoped>

</style>

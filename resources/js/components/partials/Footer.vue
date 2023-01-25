<template>
    <footer>
        <div class="container-fluid">
            <div class="d-flex footer_links align-items-center justify-content-center">

                <a v-for="page in this.pages" :key="page.id" :href="$router.resolve({name:'page', params: {slug: page.slug}}).href" >
                    {{ page.name }}
                </a>

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

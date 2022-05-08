<template>
    <div>
        <p>Welcome To Home Page</p>
        <h6>Welcome To Home</h6>
    <h1>Name :{{name}}</h1>
    <h3><b>Companny :</b>{{company}}</h3>
    <a v-bind:href="url" target="_blank">Facebook</a>
    </div>
</template>
<style scoped>
p{
    color: red;
}
</style>
<script>

export default({
    props: [
        'name',
        'company',
    ],
     data() {
        return {
            url: 'http://www.facebook.com'
        }
    }
})
</script>


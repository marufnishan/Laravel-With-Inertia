<template>
    <div>
        <p>Welcome To Home Page</p>
        <h6>Welcome To Home</h6>
    <h1>Name :{{name}}</h1>
    <h3><b>Companny :</b>{{company}}</h3>
    <a v-bind:href="url" target="_blank">Facebook</a>
    <button class="btn btn-primary m-3">Submit</button>
    <Link href="/" class="text-muted">
                <button class="btn btn-primary m-3">Home</button>
              </Link>
    <button class="btn btn-secondary m-3">Done</button>
    <h1>Hi</h1>
    </div>
</template>
<style scoped>
p{
    color: red;
}
</style>
<script>

import { Head, Link } from '@inertiajs/inertia-vue3';


export default({
    components: {
    Head,
    Link,
  },
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


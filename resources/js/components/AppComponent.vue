<template>
    <div class="appComponent">
        <Header />
        <div class="container">
            <router-view />
        </div>
    </div>
</template>
<script>
import Header from "./Header.vue";
export default {
    components: {
        Header,
    },
};
</script>
<style>

button, input{
    border: 1px solid black;
    padding: 0 5px;
    margin: 5px;
    border-radius: 5px;
}
h2{
    padding-top: 20px ;
    padding-bottom: 10px ;
    border-bottom: 1px dotted #607d8bbd;
    margin-bottom: 10px;
    text-align: center;
    font-size: 35px;
}
</style>


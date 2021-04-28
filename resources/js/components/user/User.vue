<template>
    <div class="user">
        <h2>ユーザー画面</h2>
        私の名前は<span>{{user.name}}</span><br>
        メールアドレスは<span>{{user.email}}</span>
        <br>
        <br>
        <a href="/logout">ログアウト</a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {},
        };
    },
    methods: {
        getLoginUser() {
            axios.get("/api/loginuser").then((res) => {
                this.user = res.data;
            });
        },
    },
    mounted() {
        this.getLoginUser()
    },
};
</script>
<style lang="scss" scoped>
h2{
    text-align: center;
}
span{
   color: red;
}
</style>

<template>
    <div class="header">
        <div class="header_nav">
            <router-link to="/action">action</router-link>
            <router-link to="/goal">goal</router-link>
            <router-link to="/search">search</router-link>
            <!-- <router-link to="/user">user</router-link> -->
        </div>

        <div class="header_login">
            <p>{{user.name}}</p>
            <a href="/logout">ログアウト</a>
        </div>
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
.header {
    text-align: center;
    background-color: #607d8b;
    color: #fff;
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    padding: 20px;
}
.header_nav {
    width: 70%;
}
.header_nav a {
    color: white;
    text-decoration: none;
    font-size: 30px;
    margin-right: 25px;
    padding-bottom: 3px;
}
.header_nav a:last-child {
    margin-right: 0;
}
.header_nav a.router-link-active {
    /* color: #f3920b !important; */
    font-weight: bold;
    border-bottom: 1px solid white;
}
.header_login{
    // padding: 10px ;
    // margin-right: 50px;
    width: 28%;
    p {
        margin-bottom: 0;
        font-size: 18px;
    }
    a{
        color: #FFC107;
        font-size: 13px;
        text-decoration: none;
        &:hover{
            font-weight: bold;
        }
    }
    
} 
</style>

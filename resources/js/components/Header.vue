<template>
    <div class="header">
        <ul @click='hamburgerToggle()' :class="{active:hamburger}" class="nav_icon">
            <li class="nav_icon_line"></li>
            <li class="nav_icon_line"></li>
            <li class="nav_icon_line"></li>
        </ul>

        <div :class="{active:hamburger}" class="header_nav">
            <div class="header_nav_lists">
                <router-link to="/action" class="header_nav_list">action</router-link>
                <router-link to="/goal" class="header_nav_list">goal</router-link>
                <router-link to="/search" class="header_nav_list">search</router-link>
            </div>

            <div class="header_login">
                <dt>ユーザー：{{user.name}}</dt>
                <dd><a href="/logout">ログアウト</a></dd>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {},
            hamburger: false,
        };
    },
    methods: {
        getLoginUser() {
            axios.get("/api/loginuser").then((res) => {
                this.user = res.data;
            });
        },
        hamburgerToggle() {
            this.hamburger = !this.hamburger;
        },
    },
    mounted() {
        this.getLoginUser();
    },
};
</script>

<style lang="scss" scoped>
@charset "utf-8";
/* header sp---------------------------- */
.header {
    padding: 20px;
    // background-color: #819ca9;
    .nav_icon {
        width: 40px;
        padding: 7px;
        position: relative;
        z-index: 100000;
        margin: 0 auto 0 0;
        &_line {
            background-color:black;
            z-index: 100;
            height: 2px;
            margin-bottom: 7px;
            transition: 0.5s;
            list-style: none;
            &:last-child {
                margin-bottom: 0;
            }
        }
        &.active {
            .nav_icon_line {
                &:nth-child(1) {
                    background-color: white;
                    transform: rotateZ(45deg) translateY(13px);
                }
                &:nth-child(2) {
                    opacity: 0;
                }
                &:nth-child(3) {
                    background-color: white;
                    transform: rotateZ(-45deg) translateY(-13px);
                }
            }
        }
    }
    &_nav {
        position: fixed;
        background-color: #607d8b;
        padding: 50px 15px;
        top: 0;
        bottom: 0;
        right: 70%;
        left: 0;
        z-index: 100;
        color: white;
        font-size: 25px;
        transform: translateX(-100%);
        transition: 0.5s;
        text-align: center;
        &.active {
            transform: translateX(0);
        }
        &_lists {
            a {
                display: block;
                padding: 10px;
                color: white;
                font-size: 25px;
                &:hover {
                    cursor: pointer;
                    text-decoration: none;
                    font-weight: bold;
                }
            }
        }
        .header_login {
            margin-top: 20px;
            padding-top: 30px;
            border-top: 1px dotted white;
            dt {
                font-size: 15px;
                margin: 0;
            }
            a {
                font-size: 13px;
                color: #ffc107;
                &:hover {
                    cursor: pointer;
                    text-decoration: none;
                    font-weight: bold;
                }
            }
        }
    }
}

@media (min-width: 768px) {
    /* header pc------------------------------- */
    .header {
        height: 100px;
        .nav_icon {
            display: none;
        }
        &_nav {
            right: 0;
            bottom: auto;
            transform: translateX(0);
            display: flex;
            justify-content: space-around;
            padding: 15px 40px;
            font-size: 20px;
            &_lists {
                display: flex;
                a{
                    margin-right: 35px;
                    padding-bottom: 0;
                    font-size: 25px;
                    &:last-child{
                        border: none;
                    }
                    &:hover{
                        border-bottom: 1px solid white;
                    }
                }
            }
            .header_login {
                border: none;
                padding: 0;
                margin: 0;
                dd{
                    margin-bottom: 0;
                    a {
                        padding: 0;
                        margin: 0;
                    }
                }
            }
        }
    }
    // .header_nav {
    //     text-align: center;
    //     background-color: #607d8b;
    //     color: #fff;
    //     margin-bottom: 15px;
    //     display: flex;
    //     justify-content: space-between;
    //     padding: 20px;
    // }
    // .header_nav_lists {
    //     width: 70%;
    // }
    // .header_nav_lists a {
    //     color: white;
    //     text-decoration: none;
    //     font-size: 30px;
    //     margin-right: 25px;
    //     padding-bottom: 3px;
    // }
    // .header_nav_lists a:last-child {
    //     margin-right: 0;
    // }
    // .header_nav_lists a.router-link-active {
    //     /* color: #f3920b !important; */
    //     font-weight: bold;
    //     border-bottom: 1px solid white;
    // }
    // .header_login {
    //     // padding: 10px ;
    //     // margin-right: 50px;
    //     width: 28%;
    //     p {
    //         margin-bottom: 0;
    //         font-size: 18px;
    //     }
    //     a {
    //         color: #ffc107;
    //         font-size: 13px;
    //         text-decoration: none;
    //         &:hover {
    //             font-weight: bold;
    //         }
    //     }
    // }
}
</style>

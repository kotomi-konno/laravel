<template>
    <div class="search">
        <h2>目標検索</h2>
        <form @submit.prevent="goalSearch">
            <div class="search_contents">
                <div class="search_content">
                    <p>▼ ユーザー名</p>
                    <input v-model="search.users_name" type="text"><br>
                </div>
                <div class="search_content">
                    <p>▼ 内容</p>
                    <input v-model="search.content" type="text"><br>
                </div>
                <div class="search_content">
                    <p>▼ 達成したかどうか</p>
                    <input class="search_content_checkbox" v-model="search.completed" type="checkbox"><br>
                </div>
            </div>

            <button class="search_btn">検索する</button>
        </form>

        <pre>{{$data}}</pre>

        <hr>

        <ul>
            <li v-for="(goal, index) in goals" :key="index">
                ユーザー名：<span>{{goal.users_name}}（ID：{{goal.users_id}}）</span><br>
                <!-- ユーザー名：<span>{{goal.users_id}}</span><br> -->
                内容：<span :class="{red:goal.completed}">{{goal.content}}</span><br>
                達成したかどうか：<input type="checkbox" v-model="goal.completed" disabled='disabled'><br>
            </li>
        </ul>

        <div v-show="isShow" class="pagination">
            <v-pagination v-model="nowPage" :length="maxPages" @input="getNumber"></v-pagination>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            isShow: false,
            nowPage: 1,
            maxPages: 0,
            itemsNum: 1,
            maxItems: 5,
            goalDatas: [],
            search: {
                users_name: "",
                users_id: "",
                content: "",
                completed: false,
            },
            goals: [],
        };
    },
    methods: {
        // getUsersId(){

        // }
        goalSearch() {
            axios.post("/api/goal/search", this.search).then((res) => {
                this.goalDatas = res.data;
                console.log(this.goalDatas);
                this.getNumber(1);
                this.isShow = true;
            });
        },
        getNumber(page) {
            let maxNum = this.goalDatas.length;
            this.maxPages = Math.ceil(maxNum / this.maxItems);
            this.goals.splice(0, this.goals.length);
            for (let i = 0; i < this.maxItems; i++) {
                if (i + this.maxItems * (page - 1) < maxNum - 1) {
                    this.goals.push(
                        this.goalDatas[i + this.maxItems * (page - 1)]
                    );
                }
            }
        },
    },
    mounted() {},
};
</script>
<style lang="scss" scoped>
li {
    list-style: none;
    margin-bottom: 15px;
}
// .red {
//     color: red;
// }
.pagination {
    max-width: 500px;
    margin: 20px auto;
    justify-content: center;
    nav ::v-deep .v-pagination {
        &__item {
            box-shadow: none;
            border-radius: 50%;
            color: #607d8b;
            border: 1px solid#607d8b;
            &--active {
                color: white;
                background-color: #607d8b;
            }
        }
        &__navigation {
            border: none;
            box-shadow: none;
            background-color: transparent;
            .theme--light.v-icon {
                color: #607d8b;
                font-size: 30px;
            }
            &--disabled {
                opacity: 0.2;
            }
        }
    }
}

.search {
    form {
        width: 70%;
        margin: 0 auto;
        .search_contents {
            margin: 30px auto;
            .search_content {
                margin-bottom: 15px;
                width: 100%;
                &_checkbox {
                    display: block;
                    text-align: left;
                }
                p {
                    margin-bottom: 0;
                    font-weight: bold;
                }
                input,
                select {
                    border: 1px solid grey;
                    border-radius: 5px;
                    margin: 8px;
                    padding: 3px 8px;
                    width: 95%;
                }
            }
        }
        .search_btn {
            display: block;
            text-align: center;
            text-decoration: none;
            margin: 30px auto;
            width: 30%;
            padding: 8px;
            background-color: #07889b;
            color: #fff;
            border: 1px solid #07889b;
            border-bottom: solid 4px #07414f9a;
            border-radius: 5px;
            font-weight: bold;
            font-size: 15px;
            &:active {
                transform: translateY(4px);
                border-bottom: none;
            }
        }
    }
    ul li {
        .red {
            color: red;
        }
    }
}
</style>


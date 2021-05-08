<template>
    <div class="search">
        <h2>目標検索画面</h2>
        <form @submit.prevent="goalSearch">
            ユーザー：<input v-model="search.usersName" type="text"><br>
            内容：<input v-model="search.content" type="text"><br>
            達成したかどうか：<input v-model="search.completed" type="checkbox"><br>
            <button>search</button>
        </form>

        <hr>
        <ul>
            <li v-for="(goal, index) in goals" :key="index">
                ユーザー：<span>{{goal.users_id}}</span><br>
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
                usersName: "",
                content: "",
                completed: false,
            },
            goals: [],
        };
    },
    methods: {
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
.red {
    color: red;
}
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
</style>


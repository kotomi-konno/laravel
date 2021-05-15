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

        <!-- <pre>{{$data}}</pre> -->

        <hr>

        <h3 v-show="goals!= ''">検索結果</h3>
        <ul>
            <li v-for="(goal, index) in goals" :key="index">
                ユーザー名：<span>{{goal.name}}（ID：{{goal.users_id}}）</span><br>
                <!-- ユーザー名：<span>{{goal.users_id}}</span><br> -->
                内容：<span :class="{red:goal.completed}">{{goal.content}}</span><br>
                達成したかどうか：<input type="checkbox" v-model="goal.completed" disabled='disabled'><br>
            </li>
        </ul>

        <div v-show="isShow" class="pagination">
            <v-pagination v-model="nowPage" :length="pageCount" @input="getNumber"></v-pagination>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            isShow: false,
            nowPage: 1,
            pageCount: 0,
            itemsNum: 1,
            displayDataCount: 5,
            goalDatas: [],
            search: {
                users_name: "",
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
                console.log(res.data);
                this.getNumber(1);
                this.isShow = true;
            });
        },
        getNumber(nowPage) {
            let dataCount = this.goalDatas.length;//検索結果データ数 ex)13
            this.pageCount = Math.ceil(dataCount / this.displayDataCount);//ページ数 ex)3 （1ページに表示されるのが5件だから）
            this.goals.splice(0, this.goals.length);//表示されているデータのリセット
            for (let i = 0; i < this.displayDataCount; i++) {
                let firstIndex = this.displayDataCount * (nowPage - 1);//そのページの最初のデータのインデックス
                if (firstIndex + i < dataCount) {
                    this.goals.push(
                        this.goalDatas[firstIndex + i]
                    );
                }
            }
        },
    },
    mounted(){

    }
};
</script>
<style lang="scss" scoped>
li {
    list-style: none;
    margin-bottom: 15px;
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

.search {
    width: 70%;
    margin: 0 auto;
    form {
        width: 80%;
        margin: 0 auto;
        .search_contents {
            // margin: 30px auto;
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
    h3{
        text-align: center;
    }
    ul {
        width: 80%;margin: 0 auto;
        text-align: center;

            li{
            .red {
                color: red;
            }
        }
    }
}
</style>


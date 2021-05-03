<template>
    <div class="goal">

        <div class="goalpage_inner">
            <h2>目標</h2>
            <router-link to="/goalcreate">目標を登録する</router-link>
         
            <h3>目標一覧</h3>
            <ul>
                <li v-for="(goal, index) in goals" :key="index">
                    <div class="goalpage_inner_main">
                        ユーザー：<span>{{ goal.users_name }}（ID：{{goal.users_id}}）</span><br>
                        内容：<span v-if="!goal.edit">{{ goal.content }}</span>
                        <input v-if="goal.edit" v-model="goal.content" type="text"><br>

                        締切日：<span v-if="!goal.edit">{{ goal.deadline }}</span>
                        <input v-if="goal.edit" v-model="goal.deadline" type="date"><br>

                        目標時間：<span v-if="!goal.edit">{{ goal.time }}</span>
                        <select v-if="goal.edit" v-model="goal.time" >
                            <option v-for="(n, index) in 60" :key="index" :value="`${n}:00`" >{{n}}:00</option>
                        </select><br>

                        達成したかどうか：<input v-if="!goal.edit" type="checkbox" v-model="goal.completed" disabled>
                        <input v-if="goal.edit" type="checkbox" v-model="goal.completed">
                    </div>

                    <div class="goalpage_inner_btn">
                        <button v-if="!goal.edit" @click="goal.edit = true">編集</button>
                        <button v-if="goal.edit" @click="goalUpdate(index)">更新</button>
                        <button @click="goalDelete(goal.id)">削除</button>
                    </div>
                </li>
            </ul>
            <div v-show="isShow" class="pagination">
                <v-pagination v-model="nowPage" :length="maxPages" @input="getNumber"></v-pagination>
            </div>
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

            goals: [],
        };
    },
    methods: {
        goalRead() {
            axios.get("/api/goal/read").then((res) => {
                // this.goals = res.data;
                this.goalDatas = res.data;
                this.getNumber(1);
                this.isShow = true;

                this.goals.forEach((goal) => {
                    this.$set(goal, "edit", false);
                });
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
        goalUpdate(index) {
            this.goals[index].edit = false;
            axios.put("/api/goal/update", this.goals[index]).then((res) => {
                this.goalRead();
            });
        },
        goalDelete(id) {
            if (confirm("この目標を削除しても良いですか？")) {
                axios.delete("/api/goal/delete/" + id).then((res) => {
                    this.goalRead();
                });
            }
        },
    },
    mounted() {
        this.goalRead();
    },
};
</script>
<style lang="scss" scoped>
.goalpage_inner {
    a{
        display: block;
        text-align: center;
        text-decoration: none;
        margin: 30px auto;
        width: 25%;
        padding:  8px;
        background-color:#07889b;
        color: #fff;
        border-bottom: solid 4px #07414f9a;
        border-radius: 5px;
        font-weight: bold;
        font-size: 15px;
        &:active{
            transform: translateY(4px);
            border-bottom: none;
        }
    }
    ul {
        padding: 0;
        li {
            list-style: none;
            display: flex;
            justify-content: space-around;
            padding: 15px 50px;
            border-bottom: 1px dotted rgba(128, 128, 128, 0.552);
            select {
                border: 1px solid;
                border-radius: 5px;
                width: 100px;
            }
            .goalpage_inner_btn button{
                background-color: #FFC107;
                border: none;
                padding: 8px 18px
            }
        }
    }
    h3{
        text-align: center;
        
    }
}


.pagination{
   max-width: 500px;
   margin: 20px auto;
//    margin-bottom: 15px;
   nav ::v-deep .v-pagination{
       &__item{
           color: #000066;
           border: 1px solid #000066;
           &--active{
               color: white;
               background-color: #000066;
           }
       }
       &__navigation{
           border: 1px solid #000066;
           .theme--light.v-icon{
               color: #000066;
           }
           &--disabled{
               opacity: 0.3;
           }
       }
   }
}
</style>
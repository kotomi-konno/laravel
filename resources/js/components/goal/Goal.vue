<template>
    <div class="goalComponent">
        <router-link to="/goalcreate">目標登録</router-link>

        <div class="goalpage_inner">
            <h2>目標一覧</h2>
            <hr>
            <ul>
                <li v-for="(goal, index) in goals" :key="index">
                    <div class="goalpage_inner_main">
                        ユーザー：<span>{{ goal.name }}</span><br>
                        内容：<span v-if="!goal.edit">{{ goal.content }}</span>
                        <input v-if="goal.edit" v-model="goal.content" type="text"><br>

                        締切日：<span v-if="!goal.edit">{{ goal.deadline }}</span>
                        <input v-if="goal.edit" v-model="goal.deadline" type="text"><br>

                        目標時間：<span v-if="!goal.edit">{{ goal.time }}</span>
                        <input v-if="goal.edit" v-model="goal.time" type="text"><br>

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
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            goals: [],
        };
    },
    methods: {
        goalRead() {
            axios.get("/api/goal/read").then((res) => {
                this.goals = res.data;
                this.goals.forEach((goal) => {
                    this.$set(goal, "edit", false);
                });
            });
        },
        goalUpdate(index) {
            this.goals[index].edit = false;
            axios.put("/api/goal/update", this.goals[index]).then((res) => {
                this.goalRead();
            });
        },
        goalDelete(id) {
            if(confirm("この目標を削除しても良いですか？")){
                axios.delete("/api/goal/delete/" + id).then((res) => {
                    this.goalRead();
                });
            };
        },
        // createRead() {},
    },
    mounted() {
        this.goalRead();
    },
};
</script>
<style lang="scss" scoped>
.goalComponent {
    .goalpage_inner {
        h2 {
            padding: 20px;
            text-align: center;
            margin: 0;
        }
        ul {
            padding: 0;
            li {
                list-style: none;
                display: flex;
                justify-content: space-around;
                padding: 15px 50px;
                border-bottom: 1px dotted rgba(128, 128, 128, 0.552);
            }
        }
    }
}
</style>
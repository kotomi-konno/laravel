<template>
    <div class="actionSave">
        <h2>活動入力画面</h2>

        <form @submit.prevent="actionSave">
            <div class="actionSave_contents">
                <div class="actionSave_content">
                    <p>▼ 日付</p>
                    <input type="date" v-model="newaction.done_date"><br>
                    <div v-show="newaction.error_done_date" class="error">日付を選択してください</div>
                </div>

                <div class="actionSave_content">
                    <p>▼ 取り組んだ目標</p>
                    <select v-model="newaction.goals_id">
                        <option value="0">選択してください</option>
                        <option v-for="(discomplete_goal, index) in discomplete_goals" :key="index" :value="discomplete_goal.id">{{ discomplete_goal.content }}</option>
                    </select><br>
                    <div v-show="newaction.error_goals_id" class="error">目標を選択してください</div>
                </div>

                <div class="actionSave_content">
                    <p>▼ 活動時間</p>
                    <select v-model="newaction.done_time">
                        <option value="0">選択してください</option>
                        <option v-for="(n, index) in 24" :key="index" :value="`${n}:00`">{{n}}:00</option>
                    </select><br>
                    <div v-show="newaction.error_done_time" class="error">活動時間を選択してください</div>
                </div>
            </div>
            <button class="action_btn">入力完了</button>
        </form>

    </div>
</template>


<script>
import moment from "moment";

export default {
    data() {
        return {
            newaction: {
                done_date: "",
                done_time: "",
                goals_id: 0,
                users_id: 0,
                // ↓検証用
                error_done_date: false,
                error_done_time: false,
                error_goals_id: false,
            },
            actions: [],
            goals: [],
            discomplete_goals: [],
        };
    },

    methods: {
        actionSave() {
            this.newaction.error_done_date = false;
            this.newaction.error_goals_id = false;
            this.newaction.error_done_time = false;
            if (this.newaction.done_date == "") {
                this.newaction.error_done_date = true;
            }
            if (this.newaction.goals_id == 0) {
                this.newaction.error_goals_id = true;
            }
            if (this.newaction.done_time == "") {
                this.newaction.error_done_time = true;
            }
            if (
                this.newaction.done_date != "" &&
                this.newaction.goals_id != 0 &&
                this.newaction.done_time != ""
            ) {
                axios.post("/api/action/save", this.newaction).then((res) => {
                    this.newaction.done_date = "";
                    this.newaction.done_time = "";
                    this.newaction.goals_id = 0;
                    this.actionRead();
                    this.$router.push("/action");
                });
            }
        },
        actionRead() {
            axios.get("/api/action/read").then((res) => {
                this.actions = res.data;
            });
        },

        getLoginUser() {
            axios.get("/api/loginuser").then((res) => {
                this.newaction.users_id = res.data.id;
                this.newaction.users_name = res.data.name;
            });
        },
        // 未達成のゴールで、自分が作成したゴールだけを表示させる
        getDiscompleteGoal() {
            axios.get("/api/goal/read").then((res) => {
                this.goals = res.data;
                for (let i = 0; i < this.goals.length; i++) {
                    if (
                        this.goals[i].completed == 0 &&
                        this.goals[i].users_id == this.newaction.users_id
                    ) {
                        this.discomplete_goals.push(this.goals[i]);
                    }
                }
            });
        },
        getSelectDate() {
            this.newaction.done_date = this.$route.params.selectDate;
        },
    },
    watch: {
        $route: "getSelectDate",
    },

    mounted() {
        this.actionRead();
        this.getLoginUser();
        this.getDiscompleteGoal();
        this.getSelectDate();
    },
};
</script>


<style lang="scss" scoped>
.actionSave {
    form {
        width: 70%;
        margin: 0 auto;
        .actionSave_contents {
            margin: 30px auto;
            .actionSave_content {
                margin-bottom: 15px;
                width: 100%;
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
                .error {
                    color: red;
                }
            }
        }
        .action_btn {
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
}
</style>
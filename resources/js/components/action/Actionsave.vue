<template>
    <div class="actionSave">
        <h2>活動入力画面</h2>

        <form @submit.prevent="actionSave">
            <div>
                <p>ユーザーID：{{ newaction.users_id }}</p>
                <p>ユーザーネーム：{{ newaction.users_name }}</p>
                日付：<input type="date" v-model="newaction.done_date"><br>

                取り組んだゴール：
                <select v-model="newaction.goals_id">
                    <option value="0">選択してください</option>
                    <option v-for="(discomplete_goal, index) in discomplete_goals" :key="index" :value="discomplete_goal.id">{{ discomplete_goal.content }}</option>
                </select><br>

                活動時間：
                <select v-model="newaction.done_time">
                    <option v-for="(n, index) in 24" :key="index" :value="`${n}:00`">{{n}}:00</option>
                </select><br>
            </div>

            <button>入力完了</button>
        </form>

        <pre>{{$data.discomplete_goals}}</pre>

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
                users_id: 0,
                goals_id: 0,
            },
            actions: [],
            goals: [],
            discomplete_goals: [],
        };
    },

    methods: {
        actionSave() {
            if (this.newaction.done_date != "") {
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
    },

    mounted() {
        this.actionRead();
        this.getLoginUser();
        this.getDiscompleteGoal();
    },
};
</script>


<style lang="scss" scoped>
select {
    border: 1px solid black;
    border-radius: 5px;
    margin: 5px;
    padding: 0 5px;
    width: 100px;
}
</style>
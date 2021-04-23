<template>
    <div class="goalComponent">
        <router-link to="/goalcreate">目標登録</router-link>

        <div class="goalpage_inner">
        <h2>目標一覧</h2>
            <hr>
            <ul>
                <li v-for="(goal, index) in goals" :key="index">
                    名前：<span>{{ goal.name }}</span><br>
                    内容：<span>{{ goal.content }}</span><br>
                    締切日：<span>{{ goal.deadline }}</span><br>
                    目標時間：<span>{{ goal.time }}</span><br>
                    達成したかどうか：<input type="checkbox" v-model="goal.completed" disabled="disabled"><br>
                    <hr>
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
            });
        },
        createRead(){

        },
    },
    mounted() {
        this.goalRead();
    },
};
</script>
<style lang="scss" scoped>
.goalComponent{
    .goalpage_inner{
        h2{
            padding: 20px;
            text-align: center;
        }
        ul li{
            list-style: none;
        }
    }
}
</style>
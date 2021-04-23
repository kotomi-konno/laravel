<template>
    <div class="goalComponent">

        <form @submit.prevent="goalCreate">
            取り組む内容：<input type="text" v-model="newgoal.content"><br>
            締切日：<input type="date" v-model="newgoal.deadline"><br>
            目標時間：
            <select v-model="newgoal.time">
                <option v-for="(n, index) in 35" :key="index" :value="`${n}:00`">{{n}}:00</option>
            </select>
            <button>登録</button>
        </form>

            <hr>

            <pre>{{$data}}</pre>

    </div>
</template>

<script>
export default {
    data() {
        return {
            newgoal: {
                name: "",
                content: "",
                deadline: "",
                time: "",
                completed: false,
            },
            goals: [],
        };
    },
    methods: {
        goalCreate(){
            if(this.newgoal.content != ""){
                axios.post("/api/goal/create", this.newgoal).then((res) => {
                    console.log(res.data);
                    this.newgoal.content = "";
                    this.newgoal.deadline = "";
                    this.newgoal.time = "";
                    this.newgoal.completed = false;
                    this.goalRead();
                    this.$router.push("/goal");
                });
            };
        },
        goalRead() {
            axios.get("/api/goal/read").then((res) => {
                this.goals = res.data;
            });
        },
    },
    mounted() {
        this.goalRead();
    },
};
</script>
<style lang="scss" scoped>
.goalpage_inner {
    border: 1px solid grey;
}
</style>
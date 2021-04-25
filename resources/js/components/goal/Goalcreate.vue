<template>
    <div class="goalComponent">
        <h2>目標登録画面</h2>

        <hr>

        <form @submit.prevent="goalCreate">
            <div>
                <p>ユーザーID：{{ newgoal.users_id }}</p>
                <p>ユーザーネーム：{{ newgoal.users_name }}</p>
                取り組む内容：<input type="text" v-model="newgoal.content"><br>
                締切日：<input type="date" v-model="newgoal.deadline"><br>
                目標時間：
                <select v-model="newgoal.time">
                    <option v-for="(n, index) in 60" :key="index" :value="`${n}:00`">{{n}}:00</option>
                </select><br>
            </div>
            <button>登録</button>
        </form>

        <!-- <pre>{{$data}}</pre> -->

    </div>
</template>

<script>
export default {
    data() {
        return {
            newgoal: {
                users_id: 0,
                users_name: "",
                content: "",
                deadline: "",
                time: "",
                completed: false,
            },
            goals: [],
            // user: {},
        };
    },
    methods: {
        goalCreate() {
            if (this.newgoal.content != "") {
                axios.post("/api/goal/create", this.newgoal).then((res) => {
                    console.log(res.data);
                    this.newgoal.content = "";
                    this.newgoal.deadline = "";
                    this.newgoal.time = "";
                    this.newgoal.completed = false;
                    this.goalRead();
                    this.$router.push("/goal");
                });
            }
        },
        goalRead() {
            axios.get("/api/goal/read").then((res) => {
                this.goals = res.data;
            });
        },
        getLoginUser() {
            axios.get("/api/loginuser").then((res) => {
                console.log(res.data);
                this.newgoal.users_id = res.data.id;
                this.newgoal.users_name = res.data.name;
            });
        },
    },
    mounted() {
        this.goalRead();
        this.getLoginUser();
    },
};
</script>
<style lang="scss" scoped>
.goalComponent {
    h2 {
        padding: 20px;
        text-align: center;
    }
    form {
        padding: 15px ;
        // width: 48%;
        margin: 0 auto;
        button {
            border: 1px solid black;
            padding: 0px 10px;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
            margin-top: 20px;
        }
    }
}

.goalpage_inner {
    border: 1px solid grey;
}
select {
    border: 1px solid black;
    border-radius: 5px;
    margin: 5px;
    width: 100px;
}
</style>
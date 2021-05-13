<template>
    <div class="goalCreate">
        <h2>目標登録画面</h2>

        <form @submit.prevent="goalCreate">
            <div class="goalCreate_contents">

                <div class="goalCreate_content">
                    <p>▼ 取り組む内容</p>
                    <input type="text" v-model="newgoal.content"><br>
                    <div v-show="newgoal.error_content" class="error">内容を入力してください</div>
                </div>

                <div class="goalCreate_content">
                    <p>▼ 締切日</p>
                    <input type="date" v-model="newgoal.deadline"><br>
                    <div v-show="newgoal.error_deadline" class="error">締切日を入力してください</div>
                </div>

                <div class="goalCreate_content">
                    <p>▼ 目標時間</p>
                    <select v-model="newgoal.time">
                        <option v-for="(n, index) in 60" :key="index" :value="`${n}:00`">{{n}}:00</option>
                    </select><br>
                    <div v-show="newgoal.error_time" class="error">目標時間を入力してください</div>
                </div>

            </div>
            <button class="goalCreate_btn" >登録</button>
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
                // 検証用
                error_content: false,
                error_deadline: false,
                error_time: false,
            },
            goals: [],
            
        };
    },
    methods: {
        goalCreate() {
            this.newgoal.error_content = false;
            this.newgoal.error_deadline = false;
            this.newgoal.error_time = false;
            if(this.newgoal.content == ""){
                this.newgoal.error_content = true;
            }
            if(this.newgoal.deadline == ""){
                this.newgoal.error_deadline = true;
            }
            if(this.newgoal.time == ""){
                this.newgoal.error_time = true;
            }

            if (this.newgoal.content != "" && this.newgoal.deadline != "" && this.newgoal.time != "") {
                axios.post("/api/goal/create", this.newgoal).then((res) => {
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

// .goalpage_inner {
//     border: 1px solid grey;
// }
// select {
//     border: 1px solid black;
//     border-radius: 5px;
//     margin: 5px;
//     width: 100px;
//     padding: 0 5px;
// }

.goalCreate {
    form {
        width: 70%;
        margin: 0 auto;
        .goalCreate_contents {
            margin: 30px auto;
            .goalCreate_content {
                margin-bottom: 15px;
                width: 100% ;
                p{
                    margin-bottom: 0;
                    font-weight: bold;
                }
                input , select {
                    border: 1px solid grey;
                    border-radius: 5px;
                    margin: 8px;
                    padding: 3px 8px;
                    width: 95%;
                }
                .error{
                    color: red;
                }
            }
        }
        .goalCreate_btn {
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
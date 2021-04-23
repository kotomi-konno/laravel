<template>
    <div class="searchComponent">
        <h2>検索画面</h2>
        <form @submit.prevent="goalSearch">
            達成したかどうか：<input v-model="search.completed" type="checkbox"><br>
            内容：<input v-model="search.content" type="text">
            <button>search</button>
        </form>

        <hr>
        <ul>
            <li v-for="(goal, index) in goals" :key="index">
                達成したかどうか：<input type="checkbox" v-model="goal.completed" disabled='disabled'><br>
                内容：<span :class="{red:goal.completed}">{{goal.content}}</span>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            search: {
                content: "",
                completed: false,
            },
            goals: [],
        };
    },
    methods: {
        goalSearch() {
            axios.post("/api/goal/search", this.search).then((res) => {
                this.goals = res.data;
            });
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
</style>

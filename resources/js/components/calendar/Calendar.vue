<template>
    <div class="searchComponent">
        <h2>カレンダー画面</h2>


        <pre>{{$data}}</pre>
    </div>
</template>

<script>
export default {
    data() {
        return {
            actions: [],
        };
    },
    methods: {
        actionRead() {
            axios.get("/api/action/read").then((res) => {
                console.log(res.data);
                this.actions = res.data;

            });
        },
    },
    mounted() {
        this.actionRead();
    },
};
</script>
<style lang="scss" scoped>
h2 {
    text-align: center;
}
</style>

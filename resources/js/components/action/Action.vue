<template>
    <div class="searchComponent">
        <h2>実行記録</h2>

        <!-- ページャー -->
        <div class="pager">
            <router-link v-if="month == 1"  :to="`/action/${Number(year)-1}/12`">＜</router-link>
            <router-link v-if="month != 1"  :to="`/action/${year}/${Number(month)-1}`">＜</router-link>
            <h3 class="cmn_pageTitle">{{ year }}年 {{ month }}月</h3>
            <router-link v-if="month == 12"  :to="`/action/${Number(year)+1}/1`">＞</router-link>
            <router-link v-if="month != 12"  :to="`/action/${year}/${Number(month)+1}`">＞</router-link>
        </div>

        <!-- カレンダー作成 -->
        <div class="calendar">
            <!-- 曜日表示 -->
            <ul class="indent">
                <li class="indent_item">月</li>
                <li class="indent_item">火</li>
                <li class="indent_item">水</li>
                <li class="indent_item">木</li>
                <li class="indent_item">金</li>
                <li class="indent_item">土</li>
                <li class="indent_item">日</li>
            </ul>

            <!-- 日付表示 -->
            <!-- <ul class="content">
                <li class="content_item blank"></li>

                <li v-for="calendar in calendars" :key="calendar.date" class="content_item main">
                    <span class="content_item_d"></span>
                </li>

                <li class="content_item blank"></li>
            </ul> -->

        </div>
        <!-- カレンダー↑↑↑↑ -->

        <!-- <pre>{{$data}}</pre> -->
    </div>
</template>


<script>
import moment from "moment";

export default {
    data() {
        return {
            year: 0,
            month: 0,
            actions: [],
            // calendars: [],
            first_cnt: 0,
            last_cnt: 0,
        };
    },
    methods: {
        getDate() {
            this.year = this.$route.params.year;
            this.month = this.$route.params.month;
        },
        actionRead() {
            axios.get("/api/action/read").then((res) => {
                this.actions = res.data;
            });
        },

        // カレンダー作成
        // ①最初と最後の空欄の数を求める
        getCalendar(){
            this.first_cnt = moment().startOf('month').day() -1; 
            this.last_cnt =(7-(moment().endOf('month').day()))%7; 
            console.log(this.first_cnt);
            console.log(this.last_cnt);
        },

    },
    mounted() {
        this.getDate();
        this.actionRead();
        this.getCalendar();

    },

    watch: {
        $route: "getDate",
    },
};
</script>




<style lang="scss" scoped>
h2 {
    text-align: center;
    padding: 20px;
}
.pager {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;
    &_prev {
        font-size: 15px;
        margin-right: 10px;
    }
    &_next {
        font-size: 15px;
        margin-left: 10px;
    }
}
form {
    position: relative;
    .vue-loading-wrap {
        position: absolute;
    }
}
// 曜日表示
.indent {
    display: flex;
    &_item {
        // 100%の幅を7等分にした幅のこと
        width: calc(100% / 7);
        text-align: center;
        padding-bottom: 10px;
        list-style: none;
        &:nth-child(7) {
            color: red;
        }
        &:nth-child(6) {
            color: blue;
        }
    }
}


</style>

<template>
    <div class="searchComponent">
        <h2>実行記録</h2>

        <!-- ページャー -->
        <div class="pager">
            <router-link v-if="month == 1" class="pager_prev" :to="`/action/${Number(year)-1}/12`">＜</router-link>
            <router-link v-if="month != 1" class="pager_prev" :to="`/action/${year}/${Number(month)-1}`">＜</router-link>
            <h3 class="cmn_pageTitle">{{ year }}年 {{ month }}月</h3>
            <router-link v-if="month == 12" class="pager_next" :to="`/action/${Number(year)+1}/1`">＞</router-link>
            <router-link v-if="month != 12" class="pager_next" :to="`/action/${year}/${Number(month)+1}`">＞</router-link>
        </div>

        <!-- カレンダー作成 -->
        <form v-on:submit.prevent="submit">

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
            <ul class="content">
                <li v-for="(week, index) in calendars" :key="index" >
                    <ul>
                        <li v-for="(day, index) in week" :key="index">
                            {{ day.date }}
                        </li>
                    </ul>
                </li>
            </ul>

        </form>
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
        };
    },
    methods: {
        getDate() {
            this.year = this.$route.params.year;
            this.month = this.$route.params.month;
        },
        actionRead() {
            axios.get("/api/action/read").then((res) => {
                // console.log(res.data);
                this.actions = res.data;
            });
        },

        // カレンダー作成
        getStartDate() {
            let date = moment().startOf("month");
            const youbiNum = date.day();
            return date.subtract(youbiNum - 1, "days");
        },
        getEndDate() {
            let date = moment().endOf("month");
            const youbiNum = date.day();
            return date.add(7 - youbiNum, "days");
        },
        getCalendar() {
            let startDate = this.getStartDate();
            const endDate = this.getEndDate();
            const weekNumber = Math.ceil(endDate.diff(startDate, "days") / 7);
            // ↑週数を取得

            let calendars = [];
            for (let week = 0; week < weekNumber; week++) {
                let weekRow = [];
                for (let day = 0; day < 7; day++) {
                    weekRow.push({
                        date: startDate.get("date"),
                    });
                    startDate.add(1, "days");
                }
                calendars.push(weekRow);
            }
            return calendars;
        },
    },
    mounted() {
        this.getDate();
        this.actionRead();
        console.log(this.getCalendar());
    },
    computed: {
        calendars() {
            return this.getCalendar();
        },
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
.content{
    // max-width:900px;
    border-top:1px solid grey;
    li{
        list-style: none;
        // border-left:1px solid grey;
        ul{
            display: flex;
            li{
                flex:1;
                min-height:125px;
                border-left:1px solid grey;
                border-bottom:1px solid grey;
                padding: 5px 3px 3px 5px;
                &:nth-child(7n) {
                border-right: 1px solid grey;
                }
            }
        }
    }
}

</style>

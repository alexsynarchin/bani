<template>
    <section>
        <section class="calendar-time">
            <el-time-select
                placeholder="Приход"
                v-model="startTime"
                style="margin-right: 10px"
                :picker-options="{
      start: '08:30',
      step: '00:30',
      end: '18:30'
    }">
            </el-time-select>
            <el-time-select
                placeholder="Уход"
                v-model="endTime"
                :picker-options="{
      start: '08:30',
      step: '00:30',
      end: '18:30',
      minTime: minEndTime
    }">
            </el-time-select>
        </section>
    </section>
</template>
<script>
export default {
    data() {
        return {
            startTime: '',
            endTime: ''
        };
    },
    watch: {
        startTime: function () {
            this.timeIsSelected();
        },
        endTime: function () {
            this.timeIsSelected();
        }
    },
    computed: {
        minEndTime() {
            let startHours = new Date("01/01/2018 " + this.startTime).getHours();
            let startMinutes = new Date("01/01/2018 " + this.startTime).getMinutes();
            let minTime = startHours * 60 + startMinutes + 90;
            let minHours = parseInt(minTime / 60);
            let minMinutes = minTime % 60
            if(minMinutes === 0) {
                minMinutes = "00";
            }
            return minHours + ":" + minMinutes;
        }
    },
    methods: {
        timeIsSelected() {
          if(this.startTime && this.endTime) {
            this.$emit('select-time', {startTime:this.startTime,endTime:this.endTime})
          }
        }
    }
}
</script>
<style lang="scss" >
.calendar-time {
    display: flex;
}
.el-input.is-active .el-input__inner, .el-input__inner {
    &:focus {
        border-color: #006672 !important;
    }
}
</style>

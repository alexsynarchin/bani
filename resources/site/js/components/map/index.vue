<template>
<section>
    <first-floor
        :date="date"
        :can-select="canSelect"
        :start-date="startDate"
        :end-date="endDate"
        @select-item="selectReservationItem"
    ></first-floor>
    <second-floor
        :date="date"
        :can-select="canSelect"
        :start-date="startDate"
        :end-date="endDate"
        @select-item="selectReservationItem"
    ></second-floor>
</section>
</template>
<script>
import FirstFloor from "./FirstFloor";
import SecondFloor from "./SecondFloor";
    export default {
        props: {
            date: {
                type:String,
                required:true
            },
            startDate:{
                type:String,
                required:true
            },
            endDate: {
              type:String,
              required: true
            },
            canSelect: {
                type:Boolean,
                default:false,
            }
        },
        components: {
            FirstFloor,
            SecondFloor,
        },
        data() {
            return {

            }
        },
        methods: {
            selectReservationItem(data) {
                this.$emit('select-item', data);
            }
        },
        mounted() {

        },
    }
</script>



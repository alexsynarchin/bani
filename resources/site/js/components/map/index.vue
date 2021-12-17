<template>
<section>
    <first-floor
        :can-select="canSelect"
        @select-item="selectReservationItem"
    ></first-floor>
    <second-floor
        :can-select="canSelect"
        @select-item="selectReservationItem"
    ></second-floor>
</section>
</template>
<script>
import FirstFloor from "./FirstFloor";
import SecondFloor from "./SecondFloor";
    export default {
        props: {
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



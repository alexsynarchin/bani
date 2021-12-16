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
        components: {
            FirstFloor,
            SecondFloor,
        },
        data() {
            return {
                canSelect:false,
            }
        },
        methods: {
            selectReservationItem(data) {

            }
        },
        mounted() {

        },
    }
</script>



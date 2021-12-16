<template>
<section>
    <first-floor
        :can-select="canSelect"
    ></first-floor>
    <second-floor>
        :can-select="canSelect"
    </second-floor>
</section>
</template>
<script>
import FirstFloor from "./FirstFloor";
import SecondFloor from "./SecondFloor";
    export default {
        components: {
            FirstFloor,
            SecondFloor
        },
        data() {
            return {
                canSelect:true,
            }
        },
        methods: {

        },
        mounted() {

        },
    }
</script>



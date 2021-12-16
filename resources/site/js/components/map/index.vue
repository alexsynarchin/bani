<template>
<section>
    <first-floor
        :can-select="canSelect"
    ></first-floor>
</section>
</template>
<script>
import FirstFloor from "./FirstFloor";
    export default {
        components: {
            FirstFloor,
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



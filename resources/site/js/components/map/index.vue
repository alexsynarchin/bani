<template>
<section>
    <first-floor :places="places"></first-floor>
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
                places: [
                    {
                        number:1,
                        type:'right',
                        posX:202.68,
                        posY:177.31,
                    },
                    {
                        number:2,
                        type:'right',
                        posX:202.92,
                        posY:133.65,
                    }
                ],
            }
        },
        methods: {

        },
        mounted() {

        },
    }
</script>



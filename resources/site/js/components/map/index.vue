<template>
    <section class="reserve-map">
        <img src="/assets/images/first-floor.png">
        <div v-for="place in places" class="reserve-map__place" :style="{left:place.posX + 'px',top:place.posY + 'px'}" >
            <svg viewBox="0 0 46 46">
                <use :xlink:href="'/assets/site/images/sprites.svg?ver=28#sprite-place-' + place.type"></use>
            </svg>
        </div>
    </section>
</template>
<script>
    export default {
        data() {
            return {
                places: [
                    {
                        number:1,
                        type:'right',
                        posX:211.06,
                        posY:184.3,
                    },
                    {
                        number:2,
                        type:'right',
                        posX:211.06,
                        posY:139.37,
                    }
                ],
            }
        }
    }
</script>


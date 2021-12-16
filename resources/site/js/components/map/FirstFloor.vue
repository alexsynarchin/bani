<template>
    <div class="map-floor">
        <h4 class="map-floor__title">
            1 ЭТАЖ
        </h4>
        <section class="reserve-map">
            <img src="/assets/images/first-floor.png">
            <div v-for="place in places" class="reserve-map__place" :style="{left:place.posX + 'px',top:place.posY + 'px'}" >
                <svg viewBox="0 0 44 44">
                    <use :xlink:href="'/assets/site/images/sprites.svg?ver=28#sprite-place-' + place.type"></use>
                </svg>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    props: {
        places: {
            type: Object,
            required: true
        }
    }
}

</script>
<style lang="scss" scoped>
.reserve-map {
    width: 865px;
    max-width: 865px;
    min-width: 865px;
    position: relative;
    background-color: #C5C6C6;
    &__place {
        cursor: pointer;
        position: absolute;
        z-index: 2;
        svg {
            width: 44px;
            height: 44px;
        }
        &:after {
            content: "";
            position: absolute;
            top:0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,255,102,0.6);;
        }
    }
}
.map-floor {
    width: 865px;
    max-width: 865px;
    min-width: 865px;
    &__title {
        font-family: 'Metro', sans-serif;
        text-align: center;
        font-weight: 400;
        font-size: 17px;
        color: #006672;
    }

}
</style>

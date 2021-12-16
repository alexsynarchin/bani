<template>
    <div class="map-floor">
        <h4 class="map-floor__title">
            1 ЭТАЖ
        </h4>
        <section class="reserve-map">
            <img src="/assets/images/first-floor.png">
            <div v-for="(place, index) in places"
                 @click.prevent="handleSelectPlace(place, index)"
                 class="reserve-map__place"
                 :style="{left:place.posX + 'px',top:place.posY + 'px'}"
                :class="{
                     'reserve-map__place--selected': place.select,
                }"
            >
                <span class="reserve-map__place-number" :class="{
                    'reserve-map__place-number--left' : place.type === 'left',
                    'reserve-map__place-number--right' : place.type === 'right',
                    'reserve-map__place-number--top' : place.type === 'top',
                    'reserve-map__place-number--down' : place.type === 'down',
                }">{{place.number}}</span>
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
        canSelect: {
            type: Boolean,
            default: false
        },
    },
    data() {
        return {
            places: [],
        }
    },
    methods: {
        getPlaces() {
            axios.get('/api/places/list/' + 1)
            .then((response) => {
                this.places = response.data;
            })
        },
        handleSelectPlace(place, index) {

            if(this.canSelect) {
                this.places[index].select =  !this.places[index].select;

            } else {
                this.$notify({
                    title: 'Выберите дату и время',
                    message: '',
                    type: 'warning'
                });
            }
        }
    },
    mounted() {
        this.getPlaces();
    }
}

</script>

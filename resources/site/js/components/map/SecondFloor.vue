<template>
    <div class="map-floor map-floor--second">
        <h4 class="map-floor__title">
            2 ЭТАЖ
        </h4>
        <section class="reserve-map reserve-map--second">
            <img src="/assets/images/second-floor.jpg">
            <div v-for="(cabinet, index) in cabinets"
                 @click.prevent="handleSelectCabinet(cabinet, index)"
                 class="reserve-map__cabinet"
                 :class="{
                     'reserve-map__cabinet--selected': cabinet.select,
                 }"
                 :style="{
                width:cabinet.width,
                height:cabinet.height,
                left:cabinet.posX + 'px',
                top:cabinet.posY + 'px'
            }">
                <span :class="'reserve-map__cabinet-name ' + 'reserve-map__cabinet-name--' + cabinet.number">
                    Кабинка {{cabinet.number}}
                </span>
                <svg :viewBox="'0 0 ' +  cabinet.width + ' ' + cabinet.height"
                        :style="{
                width:cabinet.width,
                height:cabinet.height,
            }">
                    <use :xlink:href="'/assets/site/images/sprites.svg?ver=8#sprite-cabin-' + cabinet.number"></use>
                </svg>
            </div>
            <div v-for="(place, index) in places"
                 @click.prevent="handleSelectPlace(place, index)"
                 class="reserve-map__place-2"
                 :style="{left:place.posX + 'px',top:place.posY + 'px'}"
                 :class="{
                     'reserve-map__place-2--selected': place.select,
                }"
            >
                <span class="reserve-map__place-2-number" :class="{
                    'reserve-map__place-2-number--left' : place.type === 'left',
                    'reserve-map__place-2-number--right' : place.type === 'right',
                    'reserve-map__place-2-number--top' : place.type === 'top',
                    'reserve-map__place-2-number--down' : place.type === 'down',
                }">{{place.number}}</span>
                <svg viewBox="0 0 35 35">
                    <use :xlink:href="'/assets/site/images/sprites.svg?ver=8#sprite-place-' + place.type + '-2'"></use>
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
            cabinets: [],
        }
    },
    methods: {
        getCabinets() {
            axios.get('/api/cabinets/list/' + 2)
                .then((response) => {
                    this.cabinets = response.data;
                })
        },
        getPlaces() {
            axios.get('/api/places/list/' + 2)
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
        },
         handleSelectCabinet(cabinet, index) {
             if(this.canSelect) {
                 this.cabinets[index].select =  !this.cabinets[index].select;
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
        this.getCabinets()
    }
}
</script>

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
                <svg viewBox="0 0 44 44" v-if="place.reserved">
                    <use :xlink:href="'/assets/site/images/sprites.svg?ver=29#sprite-place-' + place.type + '-res'"></use>
                </svg>
                <svg viewBox="0 0 44 44" v-else>
                    <use :xlink:href="'/assets/site/images/sprites.svg?ver=28#sprite-place-' + place.type"></use>
                </svg>
            </div>
        </section>
    </div>
</template>
<script>
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
            axios.get('/api/places/list/' + 1, {params:{startDate:this.startDate, endDate:this.endDate,date:this.date}})
            .then((response) => {
                this.places = response.data;
                console.log(this.places);
            })
        },
        handleSelectPlace(place, index) {
            if(this.canSelect && !place.reserved) {
                this.places[index].select =  !this.places[index].select;
                let data = {
                    id: place.id,
                    type:'place',
                    price: place.price,
                };
                this.$emit('select-item', data)

            } else if(place.reserved) {
                this.$notify({
                    title: 'Место занято',
                    message: '',
                    type: 'warning'
                });
            }
            else {
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

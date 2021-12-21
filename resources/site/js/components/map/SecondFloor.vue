<template>
    <div class="map-floor map-floor--second">
        {{startDate}}
        <h4 class="map-floor__title">
            2 ЭТАЖ
        </h4>
        <section class="reserve-map reserve-map--second">
            <img :src="$root.api_url + '/assets/images/second-floor.jpg'">
            <div v-for="(cabinet, index) in cabinets"
                 @click.prevent="handleSelectCabinet(cabinet, index)"
                 class="reserve-map__cabinet"
                 :class="{
                     'reserve-map__cabinet--selected': cabinet.select,
                 }"
                 :style="{
                width : cabinet.width,

                height : cabinet.height,
                left:cabinet.posX + 'px',
                top:cabinet.posY + 'px'
            }">
                <span :class="'reserve-map__cabinet-name ' + 'reserve-map__cabinet-name--' + cabinet.number">
                    Кабинка {{cabinet.number}}
                </span>
                <svg
                    v-if="cabinet.reserved"
                    :width="cabinet.width"
                    :height="cabinet.height"
                    :style="{
                        width:cabinet.width,
                        height:cabinet.height,
                        }"
                    :viewBox="'0 0 ' +  cabinet.width + ' ' + cabinet.height">
                    <use :xlink:href="$root.api_url + '/assets/site/images/sprites.svg?ver=11#sprite-cabin-' + cabinet.number+ '-res'"></use>
                </svg>
                <svg
                    v-else
                    :width="cabinet.width"
                    :height="cabinet.height"
                    :style="{
                        width:cabinet.width,
                        height:cabinet.height,
                        }"
                    :viewBox="'0 0 ' +  cabinet.width + ' ' + cabinet.height">
                    <use :xlink:href="$root.api_url + '/assets/site/images/sprites.svg?ver=8#sprite-cabin-' + cabinet.number"></use>
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
                <svg viewBox="0 0 35 35" v-if="place.reserved">
                    <use :xlink:href="$root.api_url +'/assets/site/images/sprites.svg?ver=8#sprite-place-' + place.type + 'res'"></use>
                </svg>
                <svg viewBox="0 0 35 35" v-else>
                    <use :xlink:href="$root.api_url + '/assets/site/images/sprites.svg?ver=8#sprite-place-' + place.type + '-2'"></use>
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
            cabinets: [],
        }
    },
    methods: {
        getCabinets() {
            axios.get( this.$root.api_url + '/api/cabinets/list/' + 2, {params:{startDate:this.startDate, endDate:this.endDate, date:this.date}})
                .then((response) => {
                    this.cabinets = response.data;
                })
        },
        getPlaces() {
            axios.get(this.$root.api_url + '/api/places/list/' + 2, {params:{startDate:this.startDate, endDate:this.endDate, date:this.date}})
                .then((response) => {
                    this.places = response.data;
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
            }
            else if(place.reserved) {
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
        },
         handleSelectCabinet(cabinet, index) {
             if(this.canSelect && !cabinet.reserved) {
                 this.cabinets[index].select =  !this.cabinets[index].select;
                 let data = {
                     id: cabinet.id,
                     type:'cabinet',
                     price: cabinet.price,
                 };
                 this.$emit('select-item', data)
             }
             else if(cabinet.reserved) {
                 this.$notify({
                     title: 'Кабинка занята',
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
        this.getCabinets()
    }
}
</script>

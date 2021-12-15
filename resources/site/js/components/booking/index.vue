<template>
    <section class="booking">
        <h3 class="booking__title">Забронировать место</h3>
        <p class="booking__description">
            Дорогие гости, для бронирования вам необходимо <br>
            выбрать дату, время, место и произвести оплату
        </p>
        <h4 class="booking-step">
            1 шаг
        </h4>
        <button class="booking-link">
            Выберите дату и время
        </button>
        <div class="mb-3 mt-3" style="width: 290px">
            <calendar
                @select-reserve-time=""
            ></calendar>
        </div>
        <reserve-map></reserve-map>
    </section>
</template>
<script>
    import calendar from '../calendar/index'
    import ReserveMap from "../map/index"
    export default {
     components: {
         'calendar':calendar,
        'ReserveMap':ReserveMap
     },
        data() {
         return {
            reserveDate:'',
            startTime: '',
            endTime:''
         }
        },

        computed: {

        },
        methods: {
         selectReserveTime(data) {

         }
        }
    }
</script>
<style lang="scss" scoped>
    .booking {
        &__title {
            font-size: 26px;
            text-align: center;
        }
        &__description {
            font-size: 17px;
            text-align: center;
        }
    }
</style>


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
        <div v-if="firstStep">
            <span class="booking-first__value">
                {{reserveData.selectedDayString}}
            </span>
            <span class="booking-first__label">
                с
            </span>
            <span class="booking-first__value">
                {{reserveData.startTime}}
            </span>
            <span class="booking-first__label">
                до
            </span>
            <span class="booking-first__value">
                {{reserveData.endTime}}
            </span>
        </div>
        <button class="booking-link" v-else @click.prevent="calendarVisible=true">
            Выберите дату и время
        </button>
        <div class="mt-4 mb-4">
            <h4 class="booking-step">
                2 шаг
            </h4>
            <p>
                Выберите любые свободные места
            </p>
        </div>

        <div class="mb-3 mt-3" style="margin-left:auto; margin-right: auto">

        </div>
        <el-dialog

            :visible.sync="calendarVisible"
            width="30%"
            class="calendar-modal"
           >
        <div slot="title"></div>
            <calendar
                @select-day-and-time="selectReserveTime"
                v-if="calendarVisible"
            ></calendar>
        </el-dialog>
        <div class="row">
            <div class="col-md-9">
                <reserve-map ref="reserve_map"></reserve-map>
            </div>
            <div class="col-md-3">

            </div>
        </div>

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
             calendarVisible:false,
             firstStep:false,
             reserveData: {
                 selectedDay:null,
                 selectedDayString:'',
                 startTime:'',
                 endTime:'',
             }

         }
        },

        computed: {

        },
        methods: {
         handleCalendarClose() {},
         selectReserveTime(data) {
            this.reserveData = data;
            this.firstStep = true;
            this.calendarVisible = false;
            this.$refs.reserve_map.canSelect = true;
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
    .booking-first {
        font-size: 17px;
        &__value {
            font-weight: 600;
            color: #006672;
        }
    }
</style>


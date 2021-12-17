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
        <div v-if="firstStep" @click.prevent="calendarVisible=true">
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
        <div class="d-flex flex-wrap">
            <div>
                <reserve-map ref="reserve_map"
                    @select-item = "selectReserveItem"
                ></reserve-map>
            </div>
            <reservation-information
                :reserve-data="reserveData"
                @order-reservation="orderReservation"
            ></reservation-information>
        </div>
        <el-dialog
            :visible.sync="orderModalVisible"
            class="reservation-order"
        >
            <div slot="title"> </div>
            <reservation-order
                :reserve-data="reserveData"
            ></reservation-order>
        </el-dialog>
    </section>
</template>
<script>
    import calendar from '../calendar/index'
    import ReserveMap from "../map/index"
    import ReservationInformation from "./ReservationInformation";
    import ReservationOrder from "./ReservationOrder";
    export default {
     components: {
         ReservationInformation,
         'calendar':calendar,
        'ReserveMap':ReserveMap,
         ReservationOrder
     },
        data() {
         return {
             calendarVisible:false,
             firstStep:false,
            orderModalVisible:false,
             reserveData: {
                 selectedDay:null,
                 selectedDayString:'',
                 startTime:'',
                 endTime:'',
                 duration: 0,
                 price: 0,
                 count:0,
             },
             reservations: [],
         }
        },
        computed: {

        },
        methods: {
         orderReservation() {
            this.orderModalVisible = true;
         },
         selectReserveItem(data) {
             var add = true;
             for(var i = 0; i < this.reservations.length; i++) {
                 if((this.reservations[i].type ===  data.type) && (this.reservations[i].id === data.id) ) {
                     this.reservations.splice(i, 1);
                     this.reserveData.price = this.reserveData.price - data.price * this.reserveData.duration
                     add = false;
                     break;
                 }
             }
             if(add) {
                 this.reservations.push(data);
                 this.reserveData.price = this.reserveData.price + data.price * this.reserveData.duration
             }
             this.reserveData.count = this.reservations.length;
         },
         handleCalendarClose() {

         },
         selectReserveTime(data) {
             console.log(data);
            this.reserveData.startTime = data.startTime;
            this.reserveData.endTime = data.endTime;
            this.reserveData.selectedDayString = data.selectedDayString;
            this.reserveData.selectedDay = data.selectedDay;
            this.firstStep = true;
            this.calendarVisible = false;
            this.$refs.reserve_map.canSelect = true;
             let startHours = new Date("01/01/2018 " + data.startTime).getHours();
             let startMinutes = new Date("01/01/2018 " + data.startTime).getMinutes();
             let endHours = new Date("01/01/2018 " + data.endTime).getHours();
             let endMinutes = new Date("01/01/2018 " + data.endTime).getMinutes();
             this.reserveData.duration = (endHours * 60 + endMinutes - startHours * 60 - startMinutes) / 60;
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


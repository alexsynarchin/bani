<template>
    <div class="booking__wrap">
        <section class="booking">
            <h3 class="booking__title">Забронировать место</h3>
            <p class="booking__description">
                Дорогие гости, для бронирования вам необходимо <br>
                выбрать дату, время, место и произвести оплату
            </p>
            <h4 class="booking-step text-center">
                1 шаг
            </h4>
            <div class="text-center">
                <div v-if="firstStep" @click.prevent="calendarVisible=true" style="cursor: pointer">
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
                    <button class="booking-link" @click.prevent="openMapModal">
                        Выберите любые свободные места
                    </button>
                </div>
            </div>
            <reservation-information
                v-if="this.reserveData.count > 0"
                :reserve-data="reserveData"
                @order-reservation="orderReservation"
            ></reservation-information>
            <el-dialog
                @closed="resultClosed"
                :visible.sync="resultVisible"
                class="result-modal"
            >
                <div slot="title"></div>
                <p style="text-align: center">
                    {{resultText}}
                </p>
            </el-dialog>
            <el-dialog

                :visible.sync="calendarVisible"
                class="calendar-modal"
            >
                <div slot="title"></div>
                <calendar
                    @select-day-and-time="selectReserveTime"
                    v-if="calendarVisible"
                ></calendar>
            </el-dialog>
            <el-dialog
                :visible.sync="mapVisible"
                class="map-modal"
            >
                <reserve-map ref="reserve_map"
                             @select-item = "selectReserveItem"
                             :can-select="canSelectMap"
                             :date="reserveData.selectedDay"
                             :start-date="reserveData.selectedDay + ' ' +  reserveData.startTime"
                             :end-date="reserveData.selectedDay + ' ' +  reserveData.endTime"
                             v-if="reserveData.startTime && reserveData.endTime && reserveData.selectedDay && mapVisible"
                ></reserve-map>
                <div class="reserve-inf__btn-wrap mt-3 pb-3" style="max-width: 300px; margin-right: auto; margin-left: auto">
                    <button class="reserve-inf__btn" @click.prevent="mapVisible = false">
                        Продолжить
                    </button>
                </div>
            </el-dialog>


            <el-dialog
                :visible.sync="orderModalVisible"
                class="reservation-order"
            >
                <div slot="title"> </div>
                <reservation-order
                    :reserve-data="reserveData"
                    :reservations="reservations"
                ></reservation-order>
            </el-dialog>
        </section>
    </div>

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
             resultVisible:false,
             resultText:'',
             order_id:null,
             canSelectMap:false,
             mapVisible:false,
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
         openMapModal() {
             if (this.canSelectMap) {
                 this.mapVisible = true;
             } else {
                 this.$notify({
                     title: 'Выберите дату и время',
                     message: '',
                     type: 'warning'
                 });
             }
         },
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
             this.reservations = [];
             this.reserveData = {
                 selectedDay:null,
                 selectedDayString:'',
                 startTime:'',
                 endTime:'',
                 duration: 0,
                 price: 0,
                 count:0,
             };
             console.log(data);
            this.reserveData.startTime = data.startTime;
            this.reserveData.endTime = data.endTime;
            this.reserveData.selectedDayString = data.selectedDayString;
            this.reserveData.selectedDay = data.selectedDay;
            this.firstStep = true;
            this.calendarVisible = false;
            this.canSelectMap = true;
             let startHours = new Date("01/01/2018 " + data.startTime).getHours();
             let startMinutes = new Date("01/01/2018 " + data.startTime).getMinutes();
             let endHours = new Date("01/01/2018 " + data.endTime).getHours();
             let endMinutes = new Date("01/01/2018 " + data.endTime).getMinutes();
             this.reserveData.duration = (endHours * 60 + endMinutes - startHours * 60 - startMinutes) / 60;
            },
            getPaymentResult(form) {
             axios.post(this.$root.api_url + '/api/payment-result', form)
                .then((response) => {
                    console.log(response.data);
                    this.resultVisible = true;
                   this.resultText = response.data;
                })
            },
            resultClosed() {
                window.location.href=('/');
            },
        },
        created() {
            let uri = window.location.search.substring(1);
            let params = new URLSearchParams(uri);
            this.order_id = params.get("orderId");
        },
        mounted() {
         if(this.order_id) {
             this.getPaymentResult({order_id:this.order_id, success:true})
         }
        }
    }
</script>
<style lang="scss">
    .booking {
        &__wrap {
            display: flex;
            justify-content: center;
            text-align: center;
        }
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
    .calendar-modal {
        .el-dialog {
            min-width: 380px;
            max-width: 520px;
        }
    }
    .map-modal {
        .el-dialog__body {
            padding: 0;
        }
        .el-dialog {
            min-width: 865px;
            max-width: 865px;
        }
    }
    .result-modal {
        .el-dialog {
            min-width: 380px;
            max-width: 460px;
        }
    }
    .booking-link {
        padding: 0;
        border: none;
        font: inherit;
        color: #006672;
        text-decoration: underline;
        background-color: transparent;
        /* отображаем курсор в виде руки при наведении; некоторые
        считают, что необходимо оставлять стрелочный вид для кнопок */
        cursor: pointer;
    }
    .booking-step {
        color: #006672;
        font-family: 'Metro', sans-serif;
    }


</style>


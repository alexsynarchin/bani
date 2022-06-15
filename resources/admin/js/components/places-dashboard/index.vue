<template>
    <div class="places-dashboard__wrap">
        <section class="places-dashboard">
            <navigation @select-date="selectDate"></navigation>
            <section class="places-dashboard__content">
                <h1 class="text-center places-dashboard__title">
                    {{date.date_string}}
                </h1>
                <section class="d-flex justify-content-between">
                    <ul class="places-reserv-list"  style="margin-right: 20px">
                        <li class="places-reserv-list__item" v-for="(place, index) in places">
                            <label class="places-reserv-list__label">Место № {{place.number}} </label>
                            <div class="places-reserv-list__reserv-wrap">
                            <span class="places-reserv-list__reserv" v-for="(reservation, index) in place.reservations"
                                  :class="{
                                'places-reserv-list__reserv--selected': (place.number === typeNumber) && (selectedType === 'place') && (selectedIndex === index)
                                  }"
                                  @click.prevent="selectReservation(reservation, place.number, 'place', index)"
                            >
                                с {{reservation.start_time}} по {{reservation.end_time}}
                            </span>
                            </div>
                        </li>
                    </ul>
                    <ul class="places-reserv-list" >
                        <li class="places-reserv-list__item" v-for="(place, index) in cabinets">
                            <label class="places-reserv-list__label">Кабинка № {{place.number}} </label>
                            <div class="places-reserv-list__reserv-wrap">
                            <span class="places-reserv-list__reserv" v-for="(reservation, index) in place.reservations"
                                  @click.prevent="selectReservation(reservation, place.number, 'cabinet', index)"
                                  :class="{
                                'places-reserv-list__reserv--selected': (place.number === typeNumber) && (selectedType === 'cabinet') && (selectedIndex === index)
                                  }"
                            >
                                с {{reservation.start_time}} по {{reservation.end_time}}
                            </span>
                            </div>
                        </li>
                    </ul>
                </section>


            </section>
        </section>

            <div class="reservation-inf" v-if="reservationInf.number">
                <h3 class="reservation-inf__title">
                    {{reservationInf.title}} № {{reservationInf.number}}
                </h3>
                <div class="reservation-inf__item">
                    <label class="reservation-inf__label">
                        Время брони:
                    </label>
                    <span class="reservation-inf__value">
                        с {{reservationInf.start}} по {{reservationInf.end}}
                    </span>
                </div>
                <div class="reservation-inf__item">
                    <label class="reservation-inf__label">
                        Имя:
                    </label>
                    <span class="reservation-inf__value">
                        {{reservationInf.client_name}}
                    </span>
                </div>
                <div class="reservation-inf__item">
                    <label class="reservation-inf__label">
                        Номер телефона:
                    </label>
                    <span class="reservation-inf__value">
                        {{reservationInf.phone}}
                    </span>
                </div>
                <div class="reservation-inf__item">
                <label class="reservation-inf__label">
                    Стоимость:
                </label>
                <span class="reservation-inf__value">
                        {{reservationInf.price}} руб.
                </span>
            </div>
            </div>

    </div>

</template>
<script>
import Navigation from "./components/navigation";
    export default {
        components: {
            Navigation,
        },
        data() {
            return {
                date: {

                },
                selectedType:'',
                selectedIndex: null,
                typeNumber:null,
                places:[],
                cabinets:[],
                reservationInf: {
                    number:null,
                    title:"",
                    start:'',
                    end:'',
                    price: '',
                    client_name:"",
                    phone: "",
                    status:''
                }
            }
        },
        methods: {
            selectDate(date) {
               this.date = date;
               this.reservationInf = {
                   number:null,
                   title:"",
                   start:'',
                   end:'',
                   client_name:"",
                   phone: "",
                   status:''
               };
               this.selectedType = '';
               this.getReservations(date);
            },
            getReservations(date) {
                axios.get('/admin/api/reservations', {params:{date:date}})
                .then((response) => {
                    this.places = response.data.places;
                    this.cabinets = response.data.cabinets;
                })
            },
            selectReservation(reservation, number, type, index) {
                this.selectedType = type;
                this.typeNumber = number;
                this.selectedIndex = index;
                if(type === 'place')
                {
                    this.reservationInf.title = "Место";
                } else {
                    this.reservationInf.title = "Кабинка";
                }
                this.reservationInf.number = number;
                this.reservationInf.price = reservation.price
                this.reservationInf.start = reservation.start_time;
                this.reservationInf.end = reservation.end_time;
                this.reservationInf.client_name = reservation.order.client.name;
                this.reservationInf.phone = reservation.order.client.phone;
                this.reservationInf.status =reservation.order.status;

            }
        }

    }
</script>

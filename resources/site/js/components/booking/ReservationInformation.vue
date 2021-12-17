<template>
    <div class="reserve-inf__wrap">
        <div class="reserve-inf">
            <h4 class="reserve-inf__title">
                3 шаг
            </h4>
            <p class="reserve-inf__descr">
                Произведите оплату <br> выбранных вами мест
            </p>
            <p class="reserve-inf__selected">
                Выбрано:
            </p>
            <ul class="reserve-inf-list">
                <li class="reserve-inf-list__item">
                    <label class="reserve-inf-list__label">
                        Мест
                    </label>
                    <span class="reserve-inf-list__value">
                                {{reserveData.count}}
                            </span>
                </li>
                <li class="reserve-inf-list__item">
                    <label class="reserve-inf-list__label">
                        Дата:
                    </label>
                    <span class="reserve-inf-list__value">
                                {{reserveData.selectedDayString}}
                            </span>
                </li>
                <li class="reserve-inf-list__item">
                    <label class="reserve-inf-list__label">
                        Время:
                    </label>
                    <span class="reserve-inf-list__value">
                            <span v-if="reserveData.startTime">c</span>
                            {{reserveData.startTime}}
                            <span v-if="reserveData.endTime">
                                      по
                            </span>
                              {{reserveData.endTime}}
                            </span>
                </li>
                <li class="reserve-inf-list__item">
                    <label class="reserve-inf-list__label">
                        Сумма:
                    </label>
                    <span class="reserve-inf-list__value">
                                {{reserveData.price}} ₽
                            </span>
                </li>
            </ul>
            <div class="reserve-inf__btn-wrap">
                <button class="reserve-inf__btn" @click.prevent="orderReservation">
                    Забронировать
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            reserveData: {
                required:true,
                type:Object,
            }
        },
        methods: {
            orderReservation() {
                if(this.reserveData.count > 0) {
                    this.$emit('order-reservation');
                } else if(this.reserveData.duration > 0) {
                    this.$notify({
                        title: 'Выберите места',
                        message: '',
                        type: 'warning'
                    });
                } else {
                    this.$notify({
                        title: 'Выберите дату и время',
                        message: '',
                        type: 'warning'
                    });
                }

            }
        }
    }
</script>

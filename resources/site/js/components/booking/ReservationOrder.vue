<template>
    <div>
        <h4 class="reservation-order__title">Оплата</h4>
        <p class="reservation-order__text">
            Информация о бронировании
        </p>
        <ul class="reservation-order-list">
            <li class="reservation-order-list__item">
                <label class="reservation-order-list__label">
                    Мест
                </label>
                <span class="reservation-order-list__value">
                                {{reserveData.count}}
                            </span>
            </li>
            <li class="reservation-order-list__item">
                <label class="reservation-order-list__label">
                    Дата:
                </label>
                <span class="reservation-order-list__value">
                                {{reserveData.selectedDayString}}
                            </span>
            </li>
            <li class="reservation-order-list__item">
                <label class="reservation-order-list__label">
                    Время:
                </label>
                <span class="reservation-order-list__value">
                            <span v-if="reserveData.startTime">c</span>
                            {{reserveData.startTime}}
                            <span v-if="reserveData.endTime">
                                      по
                            </span>
                              {{reserveData.endTime}}
                            </span>
            </li>
            <li class="reservation-order-list__item">
                <label class="reservation-order-list__label">
                    Сумма:
                </label>
                <span class="reservation-order-list__value">
                                {{reserveData.price}} ₽
                            </span>
            </li>
        </ul>
        <p class="reservation-order__text">
            Контактные данные
        </p>
        <form>
            <div class="reservation-form__group">
                <label class="reservation-form__label">
                    Имя
                </label>
                <input name="name" type="text" v-model="form.name" :class="{'is-invalid': errors.has('name')}"
                       class="form-control"  placeholder="Ваше имя">
                <div class="invalid-feedback" v-text="errors.get('name')"></div>
            </div>
            <div class="reservation-form__group">
                <label class="reservation-form__label">
                   Телефон
                </label>
                <input autocomplete="tel" name="phone" type="tel"
                       class="form-control"
                       v-phone
                       v-model="form.phone"
                       :class="{'is-invalid': errors.has('phone')}"
                       placeholder="Телефон">
                <div class="invalid-feedback" v-text="errors.get('phone')"></div>
            </div>
           <button class="reservation-form__btn" @click.prevent="submitForm">
               Оплатить
           </button>
        </form>
    </div>
</template>
<script>
import { Errors } from "../../services/errors"
export default {
    props: {
        reserveData: {
            required:true,
            type:Object,
        }
    },
    data() {
        return {
            form: {
                phone: '',
                name: ''
            },
            errors: new Errors(),
        }
    },
    methods: {
        submitForm() {
            axios.post('/api/reservation-order', this.form)
            .then((response) => {
                console.log(response.data);
            })
            .catch((error) => {
                this.errors.record(error.response.data.errors);
            })

        }
    }
}
</script>

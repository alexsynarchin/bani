<template>
    <section>

        <h3 class="text-center">
            Заказ № {{item.id}}
        </h3>
        <div style="width: 120px" class="mb-2">
            <el-alert
                v-if="item.status ==='success'"
                :closable="false"

                title="Оплачен"
                type="success">
            </el-alert>
            <el-alert
                v-if="item.status ==='cancelled'"
                :closable="false"
                title="Отменен"
                type="error">
            </el-alert>
        </div>

        <div class="mb-2">
            <label>
                Дата:
            </label>
            {{item.date}}
        </div>
        <div class="mb-2">
            <label>
                Начало брони:
            </label>
            {{item.start}}
        </div>
        <div class="mb-2">
            <label>
                Окончание брони:
            </label>
            {{item.end}}
        </div>
        <div class="d-flex flex-wrap">
            <div v-for="reservation in item.reservations" style="padding: 10px 20px;
             border: 1px dashed #000000;
             margin-right: 10px;
            border-radius: 6px;">
                <span v-if="reservation.reservationable_type === 'App\\Models\\Cabinet'">
                    Кабинка
                </span>
                <span v-if="reservation.reservationable_type === 'App\\Models\\Place'">
                    Место
                </span>

                {{reservation.reservationable.number}}
            </div>
        </div>

    </section>
</template>
<script>
    export default {
        props: {
            item: {
                type:Object,
                required:true,
            }
        }
    }
</script>

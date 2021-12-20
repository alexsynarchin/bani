<template>
<section>
    <data-tables :data="orders">
        <el-table-column
            label="Номер"
            sortable
        >
            <template slot-scope="scope">
                <div style="word-break: normal">
                    {{scope.row.id}}
                </div>
            </template>
        </el-table-column>
        <el-table-column
            label="Дата"
            prop="date"
            sortable
        >
        </el-table-column>
        <el-table-column
            label="Начало брони"
            prop="start"
            sortable
        >
        </el-table-column>
        <el-table-column
        label="Конец брони"
        prop="end"
        sortable
    ></el-table-column>
        <el-table-column
        label="Статус"
        >
            <template slot-scope="scope">
                <el-alert
                    v-if="scope.row.status ==='success'"
                    :closable="false"

                    title="Оплачен"
                    type="success">
                </el-alert>
                <el-alert
                    v-if="scope.row.status ==='cancelled'"
                    :closable="false"
                    title="Отменен"
                    type="error">
                </el-alert>

            </template>
        </el-table-column>



        <el-table-column
            label="Действия"
        >
            <template slot-scope="scope">
                <el-button
                    size="mini"
                    type="primary"
                    @click="handleView(scope.$index, scope.row)">Подробнее</el-button>
            </template>
        </el-table-column>
    </data-tables>
    <el-dialog
        :visible.sync="ModalVisible"
        >
        <order-item
            v-if="ModalVisible"
            :item="order_item"></order-item>
        <span slot="footer" class="dialog-footer">
    <el-button @click="ModalVisible = false">Закрыть</el-button>
  </span>
    </el-dialog>
</section>
</template>
<script>
import OrderItem from "./item"
export default {
    components: {
        OrderItem
    },
    data() {
        return {
            orders: [],
            order_item:null,
            ModalVisible:false,
        }
    },
    methods: {
        getOrders() {
            axios.get('/admin/orders')
            .then((response) => {
                this.orders = response.data;
            })
        },
        handleView(index, item) {
            this.ModalVisible = true;
            this.order_item = item;
        },
    },
    mounted() {
        this.getOrders();
    }
}
</script>

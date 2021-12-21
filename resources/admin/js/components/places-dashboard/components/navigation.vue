<template>
    <section>
        <ul class="dashboard-places-list">
            <li
                @click.prevent=""
                class="dashboard-places-list__item" v-for="nav in navs"
                    :class="{
                        'dashboard-places-list__item--selected' : nav.selected,
                    }"
            >
                {{nav.date_string}}
            </li>
        </ul>
    </section>
</template>
<script>
    export default {
        data() {
            return {
                date: {},
                navs:[],

            }
        },
        methods: {
            getNavs() {
                axios.get('/admin/api/places/navigation')
                .then((response) => {
                    this.navs = response.data.dates;
                })
            },
            getDate() {
                
            }
        },
        mounted() {
            this.getDate()
            this.getNavs();
        }
    }
</script>

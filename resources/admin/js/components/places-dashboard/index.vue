<template>
    <div class="places-dashboard__wrap">
        <section class="places-dashboard">
            <navigation @select-date="selectDate"></navigation>
            <section class="places-dashboard">

            </section>
        </section>
    </div>

</template>
<script>
import Navigation from "./components/navigation";
    export default {
        components: {
            Navigation,
        },
        methods: {
            selectDate(date) {

            },
        }

    }
</script>

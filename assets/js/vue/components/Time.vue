<template>
    <span id="curtime">{{currentTime.year}} Year {{currentTime.time}}</span>
</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        name: "Time",
        computed: {
            currentTime() {
                return {
                    year: this.now.format('YYYY'),
                    time: this.now.format('k:m')
                }

            },
            ...mapGetters('travel', {
                now: 'getShipDateTime'
            })
        }
    }
</script>

<style scoped>

</style>
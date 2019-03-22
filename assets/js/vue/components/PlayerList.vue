<template>
    <div class="playerlistcontent">
        <ul id="playerlist">
            <template v-for="source in sources">
                <li>
                    <a href="#" :id="source.id" @click="play(source.id)"
                       :title="source.fullName">{{source.name}}</a>
                </li>
            </template>
        </ul>
    </div>
</template>

<script>
    import {mapState} from "vuex";

    export default {
        name: "PlayerList",
        computed: mapState('sources', [
            'sources'
        ]),
        methods: {
            play(id) {
                this.$store.dispatch('player/startPlay', {id});
            }
        }
    }
</script>

<style scoped>

</style>
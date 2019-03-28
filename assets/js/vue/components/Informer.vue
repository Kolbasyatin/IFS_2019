<template>
    <div class="player_name">
        <p id="sound_name">{{message}}</p>
    </div>
</template>

<script>
    export default {
        name: "Informer",
        data() {
            return {
                message: `Название трека недоступно.`
            }
        }
    }
</script>

<style scoped>
    .player_name {
        width: 306px;
        height: 138px;
        text-align: center;
        font-size: 15px;
        font-weight: bold;
        display: table-cell;
        vertical-align: middle;
    }
</style>
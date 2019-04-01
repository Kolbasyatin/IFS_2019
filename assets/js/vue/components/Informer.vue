<template>
    <div class="player_name">
        <template v-for="(informer, key) in informers">
            <p class="sound_name" :key="key">{{prefix(informer.sourceId)}} {{informer.songName}}</p>
        </template>

    </div>
</template>

<script>
    import {mapGetters, mapState} from "vuex";

    export default {
        name: "Informer",
        computed: {
            informers() {
                let allResources = [];
                this.sources.forEach((source) => {
                    let informer = this.getInformer(source.id);
                    allResources.push(informer);
                });

                return allResources.filter( resource => {
                    return resource.sourceId === this.getCurrentSource.id || !Object.keys(this.getCurrentSource).length;
                });

            },
            ...mapGetters('informer',['getInformer']),
            ...mapGetters('sources',['getCurrentSource', 'getSourceById']),
            ...mapState('sources', ['sources'])
        },
        methods: {
            prefix(sourceId) {
                if (!Object.keys(this.getCurrentSource).length) {
                    const source = this.getSourceById(sourceId);
                    return `${source.name}: `;
                }
                return '';
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
    .sound_name {
        margin-bottom: 10px;
    }
</style>
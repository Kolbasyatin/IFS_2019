<template>
    <div>
        <div class="playerlistcontent">
            <ul id="playerlist">
                <template v-for="source in sources">
                    <li>
                        <a href="#" :id="source.id" @click="changeSource(source.id)"
                           :title="source.fullName">{{source.name}}</a>
                    </li>
                </template>
            </ul>
        </div>

        <div class="sound">

            <div class="volume">
                <p class="ui-state-default ui-corner-all ui-helper-clearfix  uiicon">
                    <span class="ui-icon ui-icon-play ui-state-disabled" id="playsource"></span>
                    <span class=".ui-icon ui-icon-pause ui-state-disabled" id="pausesource"></span>
                    Время в полете: <span id="timeleft">∞</span>
                </p>
                <p class="ui-state-default ui-corner-all ui-helper-clearfix uiicon">
                    <span class="ui-icon ui-icon-volume-on" id="mute"></span>
                    Уровень громкости <span id="volume_indicator">{{currentVolume}}%</span>
                </p>

                <!--<div id="volume_slider"-->
                     <!--class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">-->
                    <!--<div class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min"-->
                         <!--style="width: 60%;"></div>-->
                    <!--<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"-->
                          <!--style="left: 60%;"></span>-->
                <!--</div>-->
                <input class="backgrounded-radiused" type="range" min="0" max="100" step="1" v-model="currentVolume">
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapState} from "vuex";

    const audio = new Audio();
    audio.preload = 'none';
    audio.controls = false;


    export default {
        name: "Player",
        data() {
            return {
                player: audio,
                volume: 0.6
            }
        },
        computed: {
            currentVolume: {
                get: function () {
                    const volume = this.volume * 100;

                    return Math.trunc(volume);
                },
                set: function (value) {
                    this.volume = value / 100;
                }
            },
            ...mapGetters('sources', {
                currentSource: 'getCurrentSource'
            }),
            ...mapState('sources', [
                'sources', 'currentSourceId'
            ])
        },
        watch: {
            currentSource(current, previous) {
                if (Object.keys(current).length) {
                    this.play();
                } else {
                    this.pause();
                }
            },
            volume(current) {
                this.setVolume(current);
            }
        },
        methods: {
            changeSource(id) {
                this.$store.commit('sources/setSourceId', {id})
            },
            async play() {
                if (!this.player.paused) {
                    console.log('plying now!');
                    await this.player.pause();
                }
                this.player.src = this.currentSource.url;
                this.player.play();
            },
            setVolume(value) {
                this.player.volume = value;
            },
            playEvent() {
                // console.log('implement playEvent');
            },
            playingEvent() {
                // console.log('imlement playingEvent');
                console.log(this.player);
            },
            errorEvent() {
                // console.log('imlement errorEvent');

            },
            pauseEvent() {
                // console.log('imlement pauseEvent');
            }

        },
        created() {
            this.player.volume = this.volume;
            this.player.addEventListener('play', () => {
                this.playEvent();
            });
            this.player.addEventListener('playing', () => {
                this.playingEvent()
            });
            this.player.addEventListener('error', () => {
                this.errorEvent()
            });
            this.player.onpause = () => {
                console.log(this);
                // this.pauseEvent()
            };
        }
    }
</script>

<style scoped>
    .backgrounded-radiused {
        border: 1px solid #333;
        font-weight: 500;
        background: url('../../../images/ui/ui-bg_dots-small_20_333333_2x2.0f7b61f7.png');
        border-radius: 4px;
    }
</style>
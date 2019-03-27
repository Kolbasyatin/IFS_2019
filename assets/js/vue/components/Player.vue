<template>
    <div>
        <div class="playerlistcontent">
            <ul id="playerlist">
                <template v-for="source in sources">
                    <li :class="switcherClass(source.id)">
                        <a href="#" :id="source.id" @click.prevent="changeSource(source.id)"
                           :title="source.fullName">{{source.name}}</a>
                    </li>
                </template>
            </ul>
        </div>

        <div class="sound">
            <div class="volume">
                <p class="span-back">
                    <span :class="classes.resumeClass" @click.prevent="changeSource(previousSourceId)"><font-awesome-icon
                            icon="play"/></span>
                    <span :class="classes.pauseClass" @click.prevent="changeSource('')"><font-awesome-icon
                            icon="pause"/></span>
                    <span>Время в полете</span>
                </p>
                <p class="span-back"><span><font-awesome-icon :icon="volumeIcon"/> </span><span>Уровень громкости </span><span>{{currentVolume}}%</span>
                </p>
                <vue-slider v-model="currentVolume" />

            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapState} from "vuex";
    import VueSlider from 'vue-slider-component';

    const audio = new Audio();
    audio.preload = 'none';
    audio.controls = false;


    export default {
        name: "Player",
        components: {
            VueSlider
        },
        data() {
            return {
                player: audio,
                volume: 0.6,
                previousSourceId: '',
                paused: true,
                startPlaying: false
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
            volumeIcon() {
                const volume = this.currentVolume;
                if (volume === 0) {
                    return 'volume-mute'
                }
                if (volume > 0 && volume < 50) {
                    return 'volume-down'
                }

                if (volume => 50 && volume <= 100) {
                    return 'volume-up'
                }
            },
            isPaused() {
                return this.paused && this.previousSourceId;
            },
            classes() {
                return {
                    resumeClass: this.isPaused ? 'clickable' : 'disabled',
                    pauseClass: (Object.keys(this.currentSource).length && !this.paused && !this.startPlaying) ? 'clickable' : 'disabled'
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
                if (Object.keys(previous).length) {
                    this.previousSourceId = previous.id;
                } else {
                    this.previousSourceId = '';
                }

                if (Object.keys(current).length) {
                    this.play();
                } else {
                    this.pause();
                }
            },
            volume(current) {
                this.setVolume(current);
                localStorage.volume = current;
            }
        },
        methods: {
            switcherClass(id) {
                if (this.isPaused) {
                    return {
                        paused: this.previousSourceId === id
                    }
                }

                if (Object.keys(this.currentSource).length && id === this.currentSource.id) {
                    return {
                        active: !this.paused && !this.startPlaying,
                        starting: this.startPlaying
                    };
                }
            },
            changeSource(id) {
                this.$store.commit('sources/setSourceId', {id})
            },
            async play() {
                this.player.src = this.currentSource.url;
                try {
                    await this.player.play();
                } catch (error) {
                    console.log('it was interrupting playing');
                }


            },
            async pause() {
                await this.player.pause();
                this.paused = true;
            },
            setVolume(value) {
                this.player.volume = value;
            },
            playEvent() {
                this.startPlaying = true;
            },
            playingEvent() {
                this.paused = false;
                this.startPlaying = false;
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
                //Doesn't work !?!
            };
        },
        mounted() {
            if (localStorage.volume) {
                this.volume = localStorage.volume
            }
        }
    }
</script>

<style scoped>
    @import '~vue-slider-component/theme/antd.css';
</style>

<style scoped lang="less">
    .span-back {
        border: 1px solid #333;
        font-weight: 500;
        /*background: url('../../../images/ui/ui-bg_dots-small_20_333333_2x2.0f7b61f7.png');*/
        border-radius: 4px;
        padding: 4px;
        margin-top: 5px;

        & > span {
            margin-right: 4px;

            &.disabled {
                opacity: 0.35;
            }

            &.clickable {
                cursor: pointer;
            }
        }
    }

    .active {
        background: linear-gradient(91deg, #6da3e9, #1664c8, #162c47);
        background-size: 600% 600%;

        -webkit-animation: activeAnimate 11s ease infinite;
        -moz-animation: activeAnimate 11s ease infinite;
        animation: activeAnimate 11s ease infinite;
    }

    @-webkit-keyframes activeAnimate {
        0% {
            background-position: 0% 51%
        }
        50% {
            background-position: 100% 50%
        }
        100% {
            background-position: 0% 51%
        }
    }

    @-moz-keyframes activeAnimate {
        0% {
            background-position: 0% 51%
        }
        50% {
            background-position: 100% 50%
        }
        100% {
            background-position: 0% 51%
        }
    }

    @keyframes activeAnimate {
        0% {
            background-position: 0% 51%
        }
        50% {
            background-position: 100% 50%
        }
        100% {
            background-position: 0% 51%
        }
    }

    .starting {
        background: linear-gradient(78deg, #00ff64, #8377e1, #c810f2);
        background-size: 600% 600%;

        -webkit-animation: AnimationName 5s ease infinite;
        -moz-animation: AnimationName 5s ease infinite;
        animation: AnimationName 5s ease infinite;
    }

    @-webkit-keyframes AnimationName {
        0% {
            background-position: 64% 0%
        }
        50% {
            background-position: 37% 100%
        }
        100% {
            background-position: 64% 0%
        }
    }

    @-moz-keyframes AnimationName {
        0% {
            background-position: 64% 0%
        }
        50% {
            background-position: 37% 100%
        }
        100% {
            background-position: 64% 0%
        }
    }

    @keyframes AnimationName {
        0% {
            background-position: 64% 0%
        }
        50% {
            background-position: 37% 100%
        }
        100% {
            background-position: 64% 0%
        }
    }
</style>
<template>
    <div class="phoenix-audio">
        <i class="fa fa-fw" :class="playing ? 'fa-pause' : 'fa-play'" v-on:click="play"></i>
        <div class="details">
            <input type="range" v-model="progress" min="0" :max="audio.duration">
            <div class="time">
                <span>{{ currentTime }}</span>
                <span>{{ duration }}</span>
            </div>
        </div>
        <div class="volume-control">
            <i class="fa" :class="volumeIcon" v-on:click="toggleVolume"></i>
            <input type="range" v-model="volume" min="0" max="1" step="0.01">
        </div>
    </div>
</template>

<script>
    export default{
        props: {
            file: {
                type: String,
                required: true
            },
        },

        data() {
            return {
                audio: '',
                source: this.file,
                playing: false,
                volume: 1,
                progress: 0,
                duration: "00:00",
                currentTime: "00:00"
            }
        },

        computed: {
            volumeIcon: function () {
                if (this.volume > 0.8) {
                    return "fa-volume-up";
                } else if (this.volume > 0.2) {
                    return "fa-volume-down";
                }

                return "fa-volume-off";
            }
        },

        mounted() {
            this.$nextTick(function () {
                this.initSource();
            })
        },

        watch: {
            source: function (value) {
                this.initSource();
            },

            volume: function (value) {
                this.audio.volume = value;
            },

            progress: function (value, oldValue) {
                if (value < oldValue - 5 || value > oldValue + 5) {
                    this.audio.currentTime = value;
                }
            }
        },

        methods: {
            play: function () {
                if (this.audio.paused) {
                    this.audio.play();
                } else {
                    this.audio.pause();
                }
            },

            formatTime: function (seconds) {
                let minutes = Math.floor(seconds / 60);
                minutes = (minutes >= 10) ? minutes : "0" + minutes;
                seconds = Math.floor(seconds % 60);
                seconds = (seconds >= 10) ? seconds : "0" + seconds;

                return minutes + ":" + seconds;
            },

            toggleVolume: function () {
                if (this.audio.muted) {
                    this.audio.muted = false;
                    this.volume = 0.8;
                } else {
                    this.audio.muted = true;
                    this.volume = 0;
                }
            },

            initSource: function () {
                this.audio = new Audio(this.source);

                this.audio.ondurationchange = () => {
                    this.duration = this.formatTime(this.audio.duration);
                };

                this.audio.onplay = () => {
                    this.playing = true;
                };

                this.audio.onpause = () => {
                    this.playing = false;
                };

                this.audio.ontimeupdate = () => {
                    this.progress = this.audio.currentTime;
                    this.currentTime = this.formatTime(this.progress);
                };
            }
        }
    }
</script>

<style>
    .phoenix-audio {
        background: #f2f2f2;
        color: #1D2127;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 8px 10px;
    }

    .phoenix-audio i {
        cursor: pointer;
    }

    .phoenix-audio i:hover {
        color: #262626;
    }

    .phoenix-audio > .details {
        font-size: 10px;
        position: relative;
        width: 100%;
        margin: 0 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .phoenix-audio > .details > .time {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    /*Chrome*/
    @media screen and (-webkit-min-device-pixel-ratio:0) {
        .phoenix-audio > .details > input[type='range'] {
            overflow: hidden;
            height: 5px;
            margin: 0 3px;
            width: 100%;
            cursor: pointer;
            -webkit-appearance: none;
            background-color: lightgray;
        }

        .phoenix-audio > .details > input[type='range']::-webkit-slider-runnable-track {
            height: 100%;
            -webkit-appearance: none;
            color: lightgray;
            margin-top: -1px;
        }

        .phoenix-audio > .details > input[type='range']::-webkit-slider-thumb {
            width: 0;
            -webkit-appearance: none;
            height: 100%;
            background: #1D2127;
            box-shadow: -80px 0 0 80px #b2120f;
        }

    }
    /** FF*/
    .phoenix-audio > .details > input[type="range"]::-moz-range-progress {
        background-color: #b2120f;
    }
    .phoenix-audio > .details > input[type="range"]::-moz-range-track {
        background-color: lightgray;
    }

    /* IE*/
    .phoenix-audio > .details > input[type="range"]::-ms-fill-lower {
        background-color: #b2120f;
    }
    .phoenix-audio > .details > input[type="range"]::-ms-fill-upper {
        background-color: lightgray;
    }


    .phoenix-audio > .volume-control {
        display: flex;
        align-items: center;
    }

    /*Chrome*/
    @media screen and (-webkit-min-device-pixel-ratio:0) {
        .phoenix-audio > .volume-control > input[type='range'] {
            overflow: hidden;
            width: 60%;
            -webkit-appearance: none;
            background-color: lightgray;
        }

        .phoenix-audio > .volume-control > input[type='range']::-webkit-slider-runnable-track {
            height: 10px;
            -webkit-appearance: none;
            color: lightgray;
            margin-top: -1px;
        }

        .phoenix-audio > .volume-control > input[type='range']::-webkit-slider-thumb {
            width: 10px;
            -webkit-appearance: none;
            height: 10px;
            cursor: ew-resize;
            background: #1D2127;
            box-shadow: -80px 0 0 80px #e38b24;
        }

    }
    /** FF*/
    .phoenix-audio > .volume-control > input[type="range"]::-moz-range-progress {
        background-color: #e38b24;
    }
    .phoenix-audio > .volume-control > input[type="range"]::-moz-range-track {
        background-color: lightgray;
    }

    /* IE*/
    .phoenix-audio > .volume-control > input[type="range"]::-ms-fill-lower {
        background-color: #e38b24;
    }
    .phoenix-audio > .volume-control > input[type="range"]::-ms-fill-upper {
        background-color: lightgray;
    }

    .phoenix-audio > .volume-control > i {
        margin-right: 10px;
        width: 10px;
    }
</style>

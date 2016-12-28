<template>
    <div class="phoenix-audio">
        <i class="fa fa-fw" :class="isPlaying ? 'fa-pause' : 'fa-play'" v-on:click="play"></i>
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
                isPlaying: false,
            }
        },

        mounted() {
            this.$nextTick(function () {
                this.audio = new Audio(this.file);
            })
        },

        methods: {
            play: function () {
                if (this.isPlaying) {
                    this.audio.pause();
                } else {
                    this.audio.play();
                }
                this.isPlaying = !this.isPlaying;
            }
        }
    }
</script>

<style>
    .phoenix-audio {
        width: 100%;
        background: #f2f2f2;
        color: #1D2127;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        padding: 5px 0;
    }

    .phoenix-audio > i {
        cursor: pointer;
    }

    .phoenix-audio > i:hover {
        color: #262626;
    }
</style>

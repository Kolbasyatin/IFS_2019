<template>
    <div class="comment_block">
        <div class="comment_block_title">
            Комментарии к трансляции
        </div>
        <vue-custom-scrollbar class="scroll-area" :setting="settings" @ps-y-reach-end="showMoreComments">
            <template v-for="(comment, key) in comments" class="comment">
                <div class="comment" :key="key">
                    <p>{{comment.name}}</p>
                    <span>{{comment.message}}</span>
                    <span class="datetime">{{comment.date}}</span>
                </div>
            </template>

        </vue-custom-scrollbar>


        <div id="comment_add" :class="commentButtonClass">
            Комментировать
        </div>
    </div>
</template>

<script>
    // https://binaryify.github.io/vue-custom-scrollbar/en/
    import VueCustomScrollbar from "vue-custom-scrollbar/src/vue-scrollbar";
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "Comments",
        components: {VueCustomScrollbar},
        data() {
            return {
                settings: {
                    maxScrollbarLength: 50

                },
                commentButtonClass: {
                    comment_disabled: true
                },
            }
        },
        computed: {
            ...mapGetters('comments', {
                comments: 'getCurrentComments'
            })
        },
        methods: {
            ...mapActions('comments', ['showMoreComments'])
        }

    };
</script>

<style scoped lang="less">
    .comment_disabled {
        opacity: 0.1;
        cursor: default !important;
    }

    #comment_add {
        cursor: pointer;
    }

    .scroll-area {
        position: relative;
        float: left;
        width: 280px;
        height: 293px;
        margin: 0 0 6px 0;

    }

    .comment {
        display: block;
        background: rgba(255, 255, 255, 0.1);
        width: 96%;
        margin: 0 0 5px 0;
        padding: 10px 0 15px 0;
        font-size: 13px;
        float: left;
        position: relative;

        p {
            font-weight: bold;
            margin: 0 10px 0 10px;
        }

        span {
            margin: 0 10px 5px 10px;
            display: block;
        }

        .datetime {
            font-size: 9px;
            position: absolute;
            right: 0;
            bottom: -3px;
        }
    }

</style>
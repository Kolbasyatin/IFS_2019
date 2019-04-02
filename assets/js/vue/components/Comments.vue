<template>
    <div class="comment_block">
        <div class="comment_block_title">
            Комментарии к трансляции
        </div>
        <vue-custom-scrollbar class="scroll-area" :setting="settings" @ps-y-reach-end="showMoreComments">
            <transition-group
                    name="comment-wrapper"
                    appear
            >

                <div v-for="comment in comments" class="comment" :key="comment.id">
                    <p>{{comment.name}}{{sourceId}}</p>
                    <span>{{comment.message}}</span>
                    <span class="datetime">{{comment.date}}</span>
                </div>

            </transition-group>


        </vue-custom-scrollbar>


        <div id="comment_add" :class="commentButtonClass" @click.prevent="addComment">
            Комментировать
        </div>
    </div>
</template>

<script>
    // https://binaryify.github.io/vue-custom-scrollbar/en/
    import VueCustomScrollbar from "vue-custom-scrollbar/src/vue-scrollbar";
    import {mapActions, mapGetters, mapMutations} from "vuex";

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
                animateDelay: 50
            }
        },
        computed: {
            ...mapGetters('sources', {
                sourceId: 'getCurrentSourceId'
            }),
            ...mapGetters('comments', {
                comments: 'getCurrentComments'
            })
        },
        methods: {
            addComment() {
                this.addComment();
            },
            ...mapMutations('comments', {
                addComment: 'addCommentToStart'

            }),
            ...mapActions('comments', ['showMoreComments']),

        }

    };
</script>

<style scoped lang="less">


    .comment {
        display: inline-block;
        background: rgba(255, 255, 255, 0.1);
        width: 96%;
        margin: 0 0 5px 0;
        padding: 10px 0 15px 0;
        font-size: 13px;
        max-height: 50px;
        position: relative;

        p {
            font-weight: bold;
            margin: 0 10px 0 10px;
        }

        span {
            margin: 0 10px 5px 10px;
            display: inline-block;
        }

        .datetime {
            font-size: 9px;
            position: absolute;
            right: 0;
            bottom: -3px;
        }
    }


    .comment-wrapper-enter {
        max-height: 0px;
        opacity: 0;
        overflow: hidden;
    }

    .comment-wrapper-enter-active  {
        transition: opacity .7s ease;

    }


    .comment-wrapper-leave-active {
        display: none;
    }

    .comment-wrapper-move {
        transition: transform 2s;
    }



    /*.comment {*/
        /*display: inline-block;*/
        /*margin-bottom: 40px;*/
    /*}*/

    /*.comment-wrapper-leave-active {*/
        /*position: absolute;*/
    /*}*/
    /*.comment-wrapper-enter, .comment-wrapper-leave-to*/
    /*{*/
        /*opacity: 0;*/
        /*height: 30px;*/
    /*}*/
    /*.comment-wrapper-move {*/
        /*transition: transform 1s;*/
    /*}*/


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

</style>
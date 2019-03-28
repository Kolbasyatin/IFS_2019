<template>
    <div class="comment_block">
        <div class="comment_block_title">
            Комментарии к трансляции
        </div>
        <div id="comments" class="comm_box">
            <!--<div class="comment" id="commentid-id" >-->
            <!--<p>Zalex</p>-->
            <!--<span>Тут мог бы быть ваш комментарий.-->
            <!--Но скорее всего его не будет.</span>-->
            <!--<span class="datetime">01.01.3001</span>-->
            <!--</div>-->

            <template v-for="(comment, key) in comments" class="comment">
                <div class="comment" :key="key">
                    <p>{{comment.name}}</p>
                    <span>{{comment.message}}</span>
                    <span class="datetime">{{comment.date}}</span>
                </div>
            </template>

        </div>

        <div id="comment_add">
            Комментировать
        </div>
    </div>
</template>

<script>
    export default {
        name: "Comments",
        data() {
            return {
                comments: [
                    {
                        name: 'Zalex',
                        message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
                        date: '01.01.3001'
                    }
                ]
            }
        }
    }
</script>

<style scoped>

</style>
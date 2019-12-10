<template>
    <v-container grid-list-md>
        <reply
            v-for="(singleReply,index) in replies"
            :key="singleReply.id"
            :reply='singleReply'
            :index = index
        ></reply>
    </v-container>
</template>

<script>
import Reply from './SingleReply'

export default {
    props: ['replies', 'QSlug'],
    components: {Reply},
    data(){
        return{
        }
    },
    created(){
        this.listenNewReply();
        this.listenDeleteReply();
        this.broadcastReply();

        Echo.private('App.User.' + User.id())
        .notification((notification) => {
            // this.replies.unshift(notification.reply);
        });
    },
    methods: {
        listenNewReply(){
            EventBus.$on('newReply', (reply)=>{
                this.addReply(reply);
            });
        },
        listenDeleteReply(){
            EventBus.$on('deleteReply', (reply)=>{
                axios.delete(`/api${this.QSlug}/reply/${reply.id}`)
                .then(res => this.deleteReply(reply))
                .catch(err => console.log(err.response.data));
            });
        },
        broadcastReply(){
            Echo.channel('ReplyChannel')
            .listen('ReplyEvent', (e) => {
                e.type == 1 ? this.addReply(e.reply) : this.deleteReply(e.reply);
            });
        },
        addReply(reply){
            this.replies.unshift(reply);
            EventBus.$emit('newReplyCount');
        },
        deleteReply(reply){
            for (let index = 0; index < this.replies.length; index++) {
                if(this.replies[index].id == reply.id ){
                    this.replies.splice(index, 1);
                    EventBus.$emit('deleteReplyBroadcast');
                }
                
            }
        }
    }

}
</script>

<style>

</style>
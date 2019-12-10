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
                this.replies.unshift(reply);
            });
        },
        listenDeleteReply(){
            EventBus.$on('deleteReply', (index)=>{
                axios.delete(`/api${this.QSlug}/reply/${this.replies[index].id}`)
                .then(res => this.replies.splice(index, 1))
                .catch(err => console.log(err.response.data));
            });
        },
        broadcastReply(){
            Echo.channel('ReplyChannel')
            .listen('ReplyEvent', (e) => {
                e.type == 1 ? this.replies.unshift(e.reply) : this.deleteReply(e.reply);
            });
        },
        deleteReply(reply){
            this.replies.forEach(element => {
                if(element.id == reply.id){
                    this.replies.splice(element, 1);
                }
            });
        }
    }

}
</script>

<style>

</style>
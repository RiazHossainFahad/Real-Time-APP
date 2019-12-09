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
        }
    }

}
</script>

<style>

</style>
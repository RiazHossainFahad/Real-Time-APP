<template>

    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-btn icon small v-on="on">
                    <v-icon :color="color">mdi-bell-ring</v-icon> {{unReadCount}}
                </v-btn>
            </template>
            <v-list>
            <v-list-item
                v-for="(item, index) in unReadNotifi"
                :key="index"
            >
                <router-link :to="item.data.path">
                    <v-list-item-title color="blue" @click="markAsReadNotifi(item)">{{ item.data.reply_by }}<strong> Replied to</strong> {{ item.data.question }}</v-list-item-title>
                </router-link>

            </v-list-item>

            <v-list-item
                v-for="item in readNotifi"
                :key="item.id"
            >
                <router-link :to="item.data.path">
                    <v-list-item-title class="read">{{ item.data.reply_by }}<strong> Replied to</strong> {{ item.data.question }}</v-list-item-title>
                </router-link>

            </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>

<script>
export default {
    data(){
        return{
            read: [],
            unRead: [],
            unReadCount: 0,
        }
    },
    created(){
        if(User.loggedIn()){
            this.getNotifications();

            this.broadcastedNotifi();
        }
    },
    computed:{
        color(){
            return this.unReadCount > 0 ? "red" : "blue"
        },
        unReadNotifi(){
            if(this.unRead.length)
                return this.unRead;
        },
        readNotifi(){
            if(this.read.length)
                return this.read;
        }
    },
    methods: {
        getNotifications(){
            axios.post('/api/notifications')
                .then(res => {
                    this.read = res.data.read;
                    this.unRead = res.data.unRead;
                    this.unReadCount = res.data.unReadCount;
                })
                .catch(err => Exception.handle(err));
        },
        markAsReadNotifi(item){
            console.log(item);
            axios.post('/api/markAsRead', {id: item.id || item.data.id})
                .then(res => {
                    this.unRead.splice(item, 1);
                    this.unReadCount--;
                    this.read.push(item);
                })
                .catch(err => console.log(err));
        },
        broadcastedNotifi(){
            Echo.private('App.User.' + User.id())
            .notification((notification) => {
                this.unRead.unshift({data: notification});
                this.unReadCount++;
            });
        }
    }
}
</script>

<style>
.read{
    color: rgb(4, 51, 4) !important;
}
</style>
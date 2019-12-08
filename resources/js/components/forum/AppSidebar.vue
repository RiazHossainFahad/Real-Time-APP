<template>
    <v-card>
        <v-toolbar
            color="purple darken-3"
            dark
            dense
        >
            <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>
        <v-list>    
            <v-list-item v-for="(category,index) in categories" :key="index">
                <v-list-item-content>
                    <v-list-item-title>{{category.name}}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-card>
</template>

<script>
export default {
    data(){
        return {
            categories: [],
        }
    },
    created(){
        axios.get('/api/category')
            .then(res => this.categories = res.data.data)
            .catch(err => console.log(err));
    }
}
</script>

<style>

</style>
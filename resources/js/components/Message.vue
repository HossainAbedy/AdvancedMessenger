<template>
    <div class="container">
             <li class="list-group-item " :class="className">
                 <slot></slot><span class="badge badge-warning float-right" id='time'><br>{{time}}</span></li>
             <small class="badge" :class="badgeclass">{{user}}</small>
    </div>
</template>

<script>
    export default {
        props:[
            'color',
            'pos',
            'user',
            'time'
        ],
        computed:{
            className(){
                return 'list-group-item-'+this.color;
            },
             badgeclass(){
                return 'badge-'+this.color+' '+this.pos;
            },
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            },
         }, 
        watch: {
            messages(messages) {
                this.scrollToBottom();
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
#time{
    font-size: 10px;
    margin-top: 10px;
    color:black;
}
</style>

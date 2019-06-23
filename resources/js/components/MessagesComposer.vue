<template>
<div>
    <template v-if="typing != ''">
            <div class="badge badge-pill badge-warning">{{contact.name}} is {{typing}}</div>
    </template>
    <div class="composer">
       <textarea v-model="message" @keydown.enter="send" placeholder="Message..."></textarea>
    </div>
 </div>   
</template>

<script>  
    export default {
       props:{
            user:{
                type:Object,
                required:true
            },
            contact:{
                type: Object               
            },
        },
         data() {
            return {
                message: '',
                typing:'',
            };
        },
        methods:{
            send(e){
                e.preventDefault();
               if(this.message==''){
                   return;
               }
               this.$emit('send',this.message);
               this.message='';
            },
        },
        watch:{
            message(){
                Echo.private('chat')
                .whisper('typing', {
                name: this.message
                });
            }
        },
        mounted() {
            Echo.private('chat')
                .listen('ChatEvent', (e) => {
                    })             
                .listenForWhisper('typing', (e) => {
                    if(e.name!=''){
                       this.typing='Typing.....';
                    }else{
                        this.typing='';
                    }  
               
                })
        },     
    }
</script>

<style lang="scss" scoped>
.composer textarea {
    width: 96%;
    margin: 10px;
    resize: none;
    border-radius: 2px;
    border: 1px solid lightgrey;
    padding: 6px;
}
</style>

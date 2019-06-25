<template>
<div>
    <template v-if="typing != ''">
            <div class="badge badge-pill badge-warning">{{contact.name}} is {{typing}}</div>
    </template>
    <div class="totalcomposer">
        <div class="maincomposer">
            <div class="floating-div">
                <picker v-if="emoStatus" set="emojione" @select="onInput" title="Pick your emoji…" />
            </div>
            <textarea v-model="message" @keydown.enter="send" placeholder="Message..."></textarea>
        </div>
        <div class="sidecomposer">
            <div class="text-right">
                <button @click="toggleEmo" fab dark small color="pink">
                    <span>insert_emoticon </span>
                </button>
            </div>
            <div class="text-right">
                <file-upload
                    :post-action="'/conversation/send'"
                    ref='upload'
                    v-model="files"
                    @input-file="$refs.upload.active = true"
                    :headers="{'X-CSRF-TOKEN': token}"
                    :data="{contact_id:contact.id}">
                    <button class="mt-3">attach_file</button>
                </file-upload> 
            </div>
            <div class="text-right">
                <button>
                    <span>Add Friends</span>
                </button>
            </div>
        </div>
    </div>    
 </div>   
</template>

<script>
import { Picker } from 'emoji-mart-vue-fast';
import 'emoji-mart-vue-fast/css/emoji-mart.css';  
    export default {
       components:{
            Picker
        },
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
                emoStatus:false,
                files:[],
                token:document.head.querySelector('meta[name="csrf-token"]').content
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
            toggleEmo(){
               this.emoStatus= !this.emoStatus;
            },
            onInput(e){
                if(!e){
                    return false;
                }
                if(!this.message){
                    this.message=e.native;
                }else{
                    this.message=this.message + e.native;
                }
                    //  this.emoStatus=false;
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
.maincomposer textarea {
    width: 96%;
    height: 90%;
    margin: 10px;
    resize: none;
    border-radius: 2px;
    border: 1px solid lightgrey;
    padding: 6px;
}
.floating-div{
    // position: fixed;
}
.totalcomposer{
    display:flex;
}
.sidecomposer{
    flex:10%;
}
.maincomposer{
    flex:90%;   
}

</style>

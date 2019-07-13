<template>
    <div>
        <div v-if="globalmode" class="feed" ref="feed">
            <div class="jumbotron">
                    <!-- <h2 style="color:black;text-align:center"><strong>Real time chatting platform</strong></h2> -->
            <div class="row">
            <div class="offset-4 col-4 offset-sm-1 col-sm-10 card bg-black">
                <li class="list-group-item active">Chat Room 
                    <span class=" badge badge-pill badge-success float-right">ACTIVE :{{numberOfuser}}</span>
                </li>
            <div class="badge badge-pill badge-warning">{{typing}}</div>
                    <ul class="list-group" v-chat-scroll>
                        <message v-for="value,index in chat.message" 
                        :key="value.index" 
                        :color="chat.color[index]"
                        :user="chat.user[index]"
                        :pos="chat.pos[index]"
                        :time="chat.time[index]">{{value}}</message>                      
                    </ul>
                    <input type="text" class="form-control" placeholder="Type up your message" 
                     v-model="message" @keyup.enter="send">
                <a href="" class="btn btn-danger float-right" @click.prevent='deleteSession'>Clear</a>  
            </div>
        </div>
      </div>
    </div>
        <div v-else class="feed" ref="feed">
            <ul v-if="contact">
                <li v-for="message in messages" 
                :class="`message${message.to == contact.id ? ' sent' : ' received'}`" 
                :key="message.id" @click="showtime">
                    <div class="text">
                        {{message.text}}<br><span v-if="showtimechat"> {{message.created_at}}</span>
                    </div>
                    <div class="image-container">
                        <img v-if="message.image"  style="width:350px;height:350px" :src="'/storage/img/'+message.image" alt="">
                    </div>
                </li>
            </ul>
        </div>
    </div>    
</template>

<script>  
    export default {
        props:{
            contact:{
                type: Object               
            },
            messages:{
                type: Array,
                required: true
            },
            user:{
                type:Object,
                required:true
            },
            globalmode:{
                type:Boolean,
            }
        },
        data(){
            return{
                showtimechat:false,
                //globalpart 
                message:'',
                chat:{
                    message:[],
                    user:[],
                    color:[],
                    pos:[],
                    time:[]
                },
                typing:'',
                numberOfuser:0
            }
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            },
            showtime(){
                this.showtimechat=!this.showtimechat;
            },
            //globalpart
            send(){
                if(this.message.length !=0){
                this.chat.message.push(this.message);
                this.chat.color.push('success');
                this.chat.pos.push('float-right');
                this.chat.user.push('You');
                this.chat.time.push(this.getTime());
                axios.post('/sendG', {
                    message:this.message,
                    chat:this.chat
                })
                .then(response=> {
                    console.log(response);
                    this.message=''
                })
                .catch(error=>{
                    console.log(error);
                });
                }
            },

            getTime(){
                let time = new Date();
                return time.getDay()+':'+time.getHours()+':'+time.getMinutes();
                 },   
          
            getOldMessages(){
                axios.post('/getOldMessages')
                     .then(response =>{
                         console.log(response);
                         if(response.data!=''){
                            this.chat = response.data;
                         }
                     })
                     .catch(error => {
                         console.log(error);
                     });
            },

            deleteSession(){
                axios.post('/deleteSession')
                .then(response=> this.$toaster.error('Chat history is deleted') );
                this.chat=''

            },
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            },
            message(){
                Echo.private('chat')
                .whisper('typing', {
                name: this.message
                });
            }
        },
        mounted(){
           this.getOldMessages();
                Echo.private('chat')
                    .listen('ChatEvent', (e) => {
                    this.chat.message.push(e.message);
                    this.chat.user.push(e.user);
                    this.chat.pos.push('float-left');
                    this.chat.color.push('info');
                    this.chat.time.push(this.getTime());
                    //  console.log(e);
                    axios.post('/saveTosession',{
                        chat:this.chat,
                    })
                     .then(response =>{
                         
                     })
                     .catch(error => {
                         console.log(error);
                     });
                })             
                     .listenForWhisper('typing', (e) => {
                    if(e.name!=''){
                       this.typing='Typing.....';
                    }else{
                        this.typing='';
                    }  
               
                })

                Echo.join(`chat`)
                    .here((users) => {
                    this.numberOfuser=users.length;
                    })
                    .joining((user) => {
                        this.numberOfuser+=1;
                        this.$toaster.success(user.name +' just joined this room');
                    })
                    .leaving((user) => {
                        this.numberOfuser-=1;
                        this.$toaster.warning(user.name +' just left this room');
                    });
        }  
    }
</script>
 <style lang="scss" scoped>
 .feed{
     background: #f0f0f0;
     height: 100%;
     max-height: 400px;
     overflow: scroll;
     overflow-x: hidden;
     

     ul {
         list-style-type: none;
         padding: 5px;

         li {
             &.message{ 
                margin: 10px 0;
                width: 100%;

                .text {
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }
                    &.sent{
                        text-align: right;
                        .text{
                            background: #b2b2b2;
                        }
                    }

                    &.received{
                        text-align: left;
                        .text{
                            background: #81c4f9;
                    }
                }
             }
         }
     }
 }
 </style>
 
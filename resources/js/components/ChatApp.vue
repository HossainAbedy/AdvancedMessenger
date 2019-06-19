<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"></Conversation>
        <Contactlist :contacts="contacts" @selected="startConversationWith"></Contactlist>
    </div>
</template>

<script>
import Conversation from './Conversation';
import Contactlist from './Contactlist';

    export default {
        props:{
            user:{
                type:Object,
                required:true
            }
        },
        data() {
            return { 
                selectedContact: null,
                messages: [],
                contacts:[]  
            }; 
        },
        mounted() {
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    this.hanleIncoming(e.message);
                });
            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                });
        },
        components:{
             Conversation,
             Contactlist
        },
        methods:{
            startConversationWith(contact){
                this.updateUnreadCount(contact, true);
                axios.get(`/conversation/${contact.id}`)
                     .then((response)=>{
                         this.messages = response.data;
                         this.selectedContact = contact;
                     })
            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
             hanleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }
                this.updateUnreadCount(message.from_contact, false);
            },
            updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }
                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;
                    return single;
                })
            },
        }
    }
</script>

<style lang="scss" scoped>
.chat-app{
    display:flex;
}
</style>
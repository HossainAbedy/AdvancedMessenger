<template>
    <div class="contactlist">
        <ul>
            <li v-for="contact in sortedContacts" 
            :key="contact.id" 
            @click="selectContact(contact)" 
            :class="{'selected':contact == selected}">
                <div class="avatar">
                    <img v-if="(onlines.find(online=>online.name===contact.name))" class="active" :src="'/uploads/avatars/'+contact.avatar" :alt="contact.name">
                    <img v-else class="inactive" :src="'/uploads/avatars/'+contact.avatar" :alt="contact.name">
                </div>
                <div class="contact">
                    <p class="name">{{contact.name}}</p>
                    <p class="email">{{contact.email}}</p>
                    <a :href="`/viewprofile/${contact.id}`">Profile</a>
                </div>
                <!-- <div class="badge badge-pill badge-success" v-if="(onlines.find(online=>online.name===contact.name))">Active</div>
                <div class="badge badge-pill badge-danger" v-else>InActive</div> -->
                <span class="unread" v-if="contact.unread">{{ contact.unread }}</span>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props:{
            contacts:{
                type: Array,
                default:[]
            }
        },
        data(){
            return {
                selected: this.contacts.length ? this.contacts[0] : null,
                onlines:[],
            };
        },
        methods:{
            selectContact(contact){
                this.selected=contact;
                this.$emit('selected',contact);
            },
        },
        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {
                    if (contact == this.selected) {
                        return Infinity;
                    }

                    return contact.unread;
                }]).reverse();
            }
        },
        mounted(){
             Echo.join(`chat`)
                .here((user) => {
                   console.log(user);
                   this.onlines=user;
                })
                .joining((user) => {
                        console.log("joining",user.name);
                        this.onlines.push(user);
                })
                .leaving((user) => {
                        console.log("leaving",user.name);
                        this.onlines.splice(this.onlines.indexOf(user),1);
                });    
        }
    }
</script>

<style lang="scss" scoped>
    .contactlist{
        flex:2;
        max-height: 600px;
        overflow: scroll;
        border-left: 1px solid #a6a6a6;
        // background: #82e0a8 
    }
    ul {
        list-style-type: none;
        padding-left: 0;
        li {
            display: flex;
            padding: 2px;
            border-bottom: 1px solid #aaaaaa;
            height: 88px;
            position: relative;
            cursor: pointer;

            &.selected {
                background: #dfdfdf;
            }

             span.unread {
                background: #82e0a8;
                color: #fff;
                position: absolute;
                right: 11px;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px;
            }

            .avatar{
                flex:1;
                display:flex;
                align-items:center;

                img{
                    width: 45px;
                    border-radius: 60%;
                    margin: 0 auto;
                    border-width:2px;  
                    border-style:solid;               
                }
            }
            .active{
               border-color:green;
                    }
            .inactive{
               border-color:red;
                    }

            .contact{
                flex:3;
                font-size:10px;
                overflow-x: hidden;
                overflow:hidden;
                display:flex;
                flex-direction:column;
                justify-content:center;

                p{
                    margin: 0;
                    &.name{
                        font-weight:bold;
                    }
                }  
            }
        }
    }
</style>
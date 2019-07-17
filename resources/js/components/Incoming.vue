<template>
      <div>
        <li class="nav-item dropdown" style="none">
            <div class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="font-size:18px;padding-bottom:18px">
                <i class="fas fa-user-plus orange" style="font-size:18px;padding-right:15px" @click="updateUnread"><span v-if="unread" class="badge badge-pill white bg-danger">{{incoming}}</span></i> 
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <li v-for="user in users" :key="user.id">
                        <div class="avatar">
                            <a :href="`/viewprofile/${user.id}`">
                                <img class="user" :src="'/uploads/avatars/'+user.avatar" :alt="user.name">
                                <!-- <span class="unread" v-if="!unread">New</span> -->
                            </a>
                        </div>
                        <div class="contact" style="padding-left:20px">
                            <p class="name" style="font-size:15px">{{user.name}}</p>
                            <p class="email">{{user.email}}</p>
                        </div>
                        <div class="contact">
                            <Friendship :profile_user_id="user.id"></Friendship>
                        </div>
                    </li>      
                </ul>
            </div> 
          </li>         
      </div>
</template>

<script>
      export default {
            data(){
                return {
                    users:[],
                    incoming:0,
                    unread:true,
                    unreadCount:'',
                }
            },
            methods:{
                updateUnread(){
                    axios.put('/updateincoming')
                    .then((response) => {
                        this.updated = response.data;
                        this.unread = false;
                        this.incoming = 0;
                    });
                }
            },
            mounted() {
                axios.get('/getunread')
                .then((response) => {
                this.unreadCount = response.data;
                });
                axios.get('/incoming')
                .then((response) => {
                    this.users = response.data;
                })
                Echo.private('App.User.' + this.id)
                .notification((notification) => {
                    console.log(notification.type);
                    this.incoming++;
                });
            },
        props: ['id'],
      }
</script>

<style lang="scss" scoped>
    .contactlist{
        flex:2;
        max-height: 700px;
        overflow: scroll;
        overflow-x: hidden;
        border-left: 1px solid #a6a6a6;
        // background: #82e0a8 
    }
    a  {
        font-size: 30px;
        
    }
    i  {
        font-size: 30px;
       
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
                background: red;
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
                    width: 55px;
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
            .user{
               border-color:cyan;
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

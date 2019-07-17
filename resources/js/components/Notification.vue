<template>
      <div>
        <li class="nav-item dropdown" style="none">
            <div class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="font-size:18px;padding-bottom:18px">
                <i class="fas fa-bell yellow" style="font-size:18px;padding-right:15px" @click="updateUnread"><span  v-if="unread" class="badge badge-pill white bg-danger">{{notification.length}}</span></i>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <li class="dropdown-item" v-for="notification in notifications" 
                    :key="notification.id">
                        <div v-if="notifications.type = 'App\Notifications\NewFriendRequest'">
                                <h5>{{notification.data}}</h5>
                                <h6>{{notification.created_at}}</h6>
                        </div>
                        <div v-else-if="notifications.type = 'App\Notifications\FriendRequestAccepted'">
                                <h5>{{notification.data}}</h5>
                                <h6>{{notification.created_at}}</h6>
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
                    notifications:{
                        type:Object,
                        required:true
                    },
                    incoming:0,
                    unread:true,
                    unreadCount:'',
                }
            },
            mounted() {
                   axios.get('/getnotyunread')
                   .then((response) => {
                   this.unreadCount = response.data;
                   });
                   axios.get('/notification')
                   .then((response) => {
                     this.notifications = response.data;
                     
                   });
                   Echo.private('App.User.' + this.id)
                   .notification((notification) => {
                   console.log(notification.type);
                   this.incoming++;
                   });
            },
            props: ['id'],
            methods: {
                   updateUnread(){
                    axios.put('/updatenotyincoming')
                    .then((response) => {
                        this.updated = response.data;
                        this.unread = false;
                    });
                   }
            }
      }
</script>

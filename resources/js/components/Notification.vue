<template>
      <div>
        <li class="nav-item dropdown" style="none">
            <div class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="font-size:18px;padding-bottom:18px">
                <i class="fas fa-bell yellow" style="font-size:18px;padding-right:15px"></i>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <li class="dropdown-item" v-for="notification in notifications" 
                    :key="notification.id">
                        <div v-if="notifications.type = 'App\Notifications\NewFriendRequest'">
                                <h5>{{notification.data}}</h5>
                        </div>
                        <div v-else-if="notifications.type = 'App\Notifications\FriendRequestAccepted'">
                                <h5>{{notification.data}}</h5>
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
                }
            },
            mounted() {
                   axios.get('/notification')
                   .then((response) => {
                     this.notifications = response.data;
                     
                   });
                   this.listen()
                   },
            props: ['id'],
            methods: {
                  listen() {
                        Echo.private('App.User.' + this.id)
                            .notification( (notification) => {
                                  noty({
                                          type: 'success',
                                          layout: 'bottomLeft',
                                          text: notification.name + notification.message
                                  })
                                  this.$store.commit('add_not', notification)
                                  document.getElementById("noty_audio").play()                             
                            })
                  },
                  showNotification(){
                      this.show =! this.show;
                  }
            }
      }
</script>

 
                    <!-- <h5>{{info}}</h5> -->
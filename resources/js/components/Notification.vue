<template>
      <div>
        <li class="nav-item dropdown">
            <a href="#" 
              @click="showNotification">
                <i class="fas fa-bell yellow" style="font-size:18px;padding-right:15px"></i>
            </a>
            <div class="dropdown-toggle bg-light" data-toggle="dropdown" role="button" aria-expanded="false" v-if="show">
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                   <li class="dropdown-item">notification</li>
                </ul>
            </div> 
          </li>         
      </div>
</template>

<script>
      export default {
            data(){
                return {
                    show:false,
                }
            },
            mounted() {
                  this.listen()
            },
            props: ['id'],
            methods: {
                  listen() {
                        Echo.private('App.User.' + this.id)
                            .notification( (notification) => {
                                //   noty({
                                //           type: 'success',
                                //           layout: 'bottomLeft',
                                //           text: notification.name + notification.message
                                //   })
                                //   this.$store.commit('add_not', notification)
                                //   document.getElementById("noty_audio").play()
                            })
                  },
                  showNotification(){
                      this.show =! this.show;
                  }
            }
      }
</script>
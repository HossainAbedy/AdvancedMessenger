<template>
        <div>
            <p class="text-center" v-if="loading">
                Loading...
            </p>
            <p class="text-center" v-if="!loading">
                <button class="btn btn-success" v-if="status == 0" @click="add_friend">Add   <i class="fas fa-user"></i></button>
                <button class="btn btn-warning" v-if="status == 'pending'" @click="accept_friend">Accept   <i class="fas fa-user-plus"></i></button>
                <span class="text-danger" v-if="status == 'waiting'">Waiting for response</span>
                <span class="text-success" v-if="status == 'friends'">Friends</span>
            </p>
        </div>
</template>

<script>
    export default {
        props:{
            profile_user_id:{
                type: Number,

            }
        },
        data() {
            return {
                status: '',
                loading: true
            }
        },
        methods: {
            add_friend() {
                this.loading = true
                axios.get('/add_friend/' + this.profile_user_id )
                    .then( (r) => {
                        if(r.data == 1)
                            this.status = 'waiting'
                            noty({
                                type: 'success',
                                layout: 'bottomLeft',
                                text: 'Friend request sent .'
                            })
                            this.loading = false
                    })
            },
            accept_friend() {
                this.loading = true
                axios.get('/accept_friend/' + this.profile_user_id )
                    .then( (r) => {
                        if(r.data == 1)
                            this.status = 'friends'
                            noty({
                                type: 'success',
                                layout: 'bottomLeft',
                                text: 'You are now friend. Go ahead and hangout .'
                            })
                            this.loading = false
                    })
            }
        },
        mounted() {
            axios.get('/check_relationship_status/'+ this.profile_user_id )
                .then( (resp) => {
                    console.log(resp)
                    this.status = resp.data.status
                    this.loading = false
                })
        },
    }
</script>
<template>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img :src="'/uploads/avatars/'+user.avatar" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h4>Your Profile</h4>
             <div class="card-tools">
                <button type="button" class="btn btn-success float-right" @click="newModal">UPDATE
                <i class="fas fa-user-plus fa-fw"></i></button>
            </div>
            <label style="color:red"><strong>Name:</strong></label>{{user.name}}<br>
            <label style="color:red"><strong>Email:</strong></label>{{user.email}}<br>
            <h4>Your Details</h4>
            <div>
                <h2 class="text-center" style="color:green">{{user.welcome_text}}</h2>
            </div>
            <div>
                <p class="text-center" style="color:blue"><strong>{{user.bio}}</strong></p>
            </div>    
            <label style="color:red"><strong>Birth Date:</strong></label>{{user.birth_date}} <br> 
            <label style="color:red"><strong>Sex:</strong></label>{{user.sex}} <br>  
            <label style="color:red"><strong>Work:</strong></label>{{user.work}} <br> 
            <label style="color:red"><strong>Education:</strong></label>{{user.education}} <br> 
            <label style="color:red"><strong>Religion:</strong></label>{{user.religion}} <br> 
            <label style="color:red"><strong>Phone:</strong></label>{{user.phone}} <br> 
            <label style="color:red"><strong>Address:</strong></label> {{user.address}}<br>
               <br> 
                 <br> 
                 <br> 
                 <br> 
                 <br> 
                 <br> 
                 <br>
                 <br> 
                 <br> 
                 <br> 
                 <br>    
    </div>
       <!-- Modal -->
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNew">Edit</h5> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <form @submit.prevent="updateUser()" @keydown="form.onKeydown($event)">
                <div class="modal-body">
                    <div class="form-group">
                        <input v-model="form.name" type="text" name="name"
                            placeholder="Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.email" type="email" name="email"
                            placeholder="Email Address"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.welcome_text" type="text" name="welcome_text"
                            placeholder="Welcome Text"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('welcome_text') }">
                        <has-error :form="form" field="welcome_text"></has-error>
                    </div>

                    <div class="form-group">
                        <textarea v-model="form.bio" name="bio" id="bio"
                        placeholder="Short bio for user (Optional)"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                        <has-error :form="form" field="bio"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.birth_date" type="date" name="birth_date"
                            placeholder="Date of Birth"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('birth_date') }">
                        <has-error :form="form" field="birth_date"></has-error>
                    </div>

                    <div class="form-group">
                        <select name="sex" v-model="form.sex" id="sex" class="form-control" :class="{ 'is-invalid': form.errors.has('sex') }">
                            <option value="">Select Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        <has-error :form="form" field="sex"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.work" type="text" name="work"
                            placeholder="work"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('work') }">
                        <has-error :form="form" field="work"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.education" type="text" name="education"
                            placeholder="education"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('education') }">
                        <has-error :form="form" field="education"></has-error>
                    </div>

                    <div class="form-group">
                        <select name="religion" v-model="form.religion" id="religion" class="form-control" :class="{ 'is-invalid': form.errors.has('religion') }">
                            <option value="">Select Religion</option>
                            <option value="Islam">Islam</option>
                            <option value="Chistian">Chistian</option>
                            <option value="Buddhist">Buddhist</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Others">Others</option>
                        </select>
                        <has-error :form="form" field="religion"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.phone" type="text" name="phone"
                            placeholder="phone"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                        <has-error :form="form" field="phone"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.address" type="text" name="address"
                            placeholder="address"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                        <has-error :form="form" field="address"></has-error>
                    </div>

                 <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                 </div>
                </div>
              </form>
           </div>
         </div>
      </div> 
    </div>
</template>

<script>

export default {
        props:{
            user:{
                type:Object,
                required:true
            }
        }, 

        data(){
           return {
                form : new Form ({
                    id:'',
                    name: '',
                    email: '',
                    welcome_text: '',
                    bio: '',
                    sex: '',
                    birth_date: '',
                    work: '',
                    education: '',
                    religion: '',
                    phone: '',
                    address: '',
                })
            }
        },

        methods: {
            newModal(){
                this.form.reset();
                $('#addNew').modal('show')
            },
            updateUser(){
               this.form.put('/updateprofile')
                .then((response) => {
                    // success
                    $('#addNew').modal('hide');
                }) 
            }
           
        },

        
}
</script>

<style>

</style>

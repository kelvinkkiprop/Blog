<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">                        
                        <h3 class="card-title">Update User</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" @submit.prevent="updateUser(user.id)"> 
                            <!-- Name  -->                           
                            <div class="form-group">
                                <label for="name" class="col-form-label required">Name:</label>
                                <input id="name" type="name" class="form-control" name="name"
                                v-model="user.name" autocomplete="name" autofocus required>
                            </div> 
                            <!-- Email  -->
                            <div class="form-group">
                                <label for="email" class="col-form-label required">Email:</label>
                                <input id="email" type="email" class="form-control" name="email"
                                v-model="user.email" autocomplete="email" autofocus required>
                            </div>                                
                            <!-- Type  -->                        
                            <div class="form-group">
                                <label for="type" class="col-form-label required">Type:</label>
                                <select id="type" type="text" class="form-control" name="type" 
                                v-model="user.type" autocomplete="type" autofocus required>
                                    <option value="0" disabled="true" selected="true">--- Select Type ---</option>
                                    <option value="1">System Administrator</option>
                                    <option value="2">Normal</option>
                                </select>
                            </div>  

                            <!-- Buttons --> 
                            <button type="submit" class="btn btn-success">Update</button>
                            <router-link to="/users" class="btn btn-outline-warning">Cancel</router-link>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    
    export default {
        //Data
        data() {
            return { 
                //User object
                user: {},  
                user: {
                    name: '',
                    email: '',
                    type: ''
                },            
            }
        },

        //Created
         created() {
             //User if drom vue router
            this.id = this.$route.params.id;
            var uid = this.id;
            // console.log('This is my id from vue router'+uid);
             axios.get('/api/users/'+uid+'/edit').then((response)=>{
                // this.users = response.data;
                console.log(response.data.id);
                this.user = response.data;
            });

        },

        //Method
        methods: {

            //Update
            updateUser(id){

                //Show
                this.$Progress.start();

                // console.log(this.user.name);
                var data = this.user;
                axios.put('/api/users/'+id, data)
                .then(response => {
                    console.log(response);
                    //Clear form
                    this.user =   {
                        name: '',
                        email: '',
                        type: ''
                    }   

                    //Redirect to users
                    this.$router.push({ name: 'users' })

                    //Show                    
                    this.$toastr.i(""+response.data.message, "Info");

                    //Close
                    this.$Progress.finish();

                }).catch(error => {
                    var toastr = this.$toastr;
                    Object.values(error.response.data.errors).forEach(function(value) {
                        // alert(value[0]); 
                        toastr.e(value[0], "Error");

                    });
                    //Finish
                    this.$Progress.fail();
                    
                })
            },
         

        }

    }
</script>
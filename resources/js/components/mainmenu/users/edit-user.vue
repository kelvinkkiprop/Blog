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
                                    <option v-for="user_type in user_types" :value="user_type.id" :key="user_type.id">
                                        {{ user_type.name }}
                                    </option>
                                </select>
                            </div>     
                            <!-- Password  -->
                            <div class="form-group">
                                <label for="password" class="col-form-label required">Password:</label>
                                <input id="password" type="password" class="form-control" name="password"
                                v-model="user.password" autocomplete="password" autofocus required>
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
                user_types: [],
                user: {
                    name: '',
                    email: '',
                    type: '',
                    password: ''
                },            
            }
            
        },

        //Created
         created() {

             //User from all users
            this.id = this.$route.params.id;
            var uid = this.id;
            // console.log('This is my id from vue router'+uid);
             axios.get('/api/users/'+uid+'/edit').then((response)=>{
                // this.users = response.data;
                this.user = response.data;
            });

            //Fetch user types
             axios.get('/api/user_types').then((response)=>{
                // console.log(response.data);
                this.user_types = response.data;
            });

        },

        //Method
        methods: {

            //Update
            updateUser(id){

                // console.log(this.user.name);
                var data = this.user;
                axios.put('/api/users/'+id, data)
                .then(response => {

                    //Clear form
                    this.user =   {
                        name: '',
                        email: '',
                        type: '',
                        password: ''
                    }   

                    //Redirect to users
                    this.$router.push({ name: 'users' })

                    //Show                    
                    this.$toastr.i(""+response.data.message, "Info");

                }).catch(error => {
                    var toastr = this.$toastr;
                    Object.values(error.response.data.errors).forEach(function(value) {
                        // alert(value[0]); 
                        toastr.e(value[0], "Error");

                    });
                    
                })
            },
         

        }

    }
</script>
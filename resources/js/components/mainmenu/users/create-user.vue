<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">                        
                        <h3 class="card-title">Create User</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" @submit.prevent="createUser"> 
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
                                autocomplete="type" autofocus required v-bind="(type, index) in users_types" :key="type.id">
                                    <option value="0" disabled="true" selected="true">--- Select User Type ---</option>
                                    <option value="{{ type.id }}">{{ type.name }}</option>
                                </select>
                            </div>  

                            <!-- Buttons --> 
                            <button type="submit" class="btn btn-success">Save</button>
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
                user_types: {}, 
                user: {
                    name: '',
                    email: '',
                    type: ''
                },            
            }
        },

        //Created
         created() {
             axios.get('/api/user_types').then((response)=>{
                // console.log(response.data);
                this.user_types = response.data;
            });
        },

        //Method
        methods: {

            //Create
            createUser(id){

                // console.log(this.user.name);
                var data = this.user;
                axios.post('/api/users/', data)
                .then(response => {
                    // console.log(response);
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
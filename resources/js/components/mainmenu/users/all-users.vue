<template>
    <!-- Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                 <!-- Card -->
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        <div class="card-tools">
                            <router-link to="create-user" class="btn btn-success btn-sm">Add New
                                <i class="fas fa-user-plus fa-fw" aria-hidden="true"></i>
                            </router-link>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, index) in users" :key="user.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ user.name | capitalize }}</td>
                                        <td>{{ user.email }}</td>
                                        <th>{{ user.type }}</th>
                                        <td><span class="badge badge-success">Active</span></td>
                                        <td>{{user.created_at | myDate }}</td>
                                        <td>
                                            <router-link :to="'/edituser/' + user.id" class="btn btn-dark btn-sm">
                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                            </router-link>
                                            <button class="btn btn-danger btn-sm" @click="deleteUser(user.id)">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                        
                    </div>

                </div>
                <!-- ./ Card -->

            </div>
        </div>


        <!-- Add New Modal -->
        <div class="modal" id="addNewModal">
            <div class="modal-dialog">
                <div class="modal-content"> 
                    <form method="POST" @submit.prevent="createNew()">                        
                        <div class="modal-header bg-success text-white">
                            <h4 class="modal-title">Add User</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
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
                        </div>
                        <div class="modal-footer bg-dark">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ./ Add New Modal -->


    </div>
    <!-- ./Container -->

</template>

<script>

    export default {
        //Props for user editing
        // props:['user'],

        //Data
        data() {
            return { 
                users : {},
                user: {
                    name: '',
                    email: '',
                    type: ''
                },               
            }
        },

        //Method
        methods: {

            //Load
            loadUsers(){                            
                axios.get('api/users')
                .then(response => {
                    response.data
                    this.users = response.data;
                    // console.log(this.users);
                });
            },

            //Create
            createNew(){

                //Show
                this.$Progress.start();

                // console.log(this.user.name);
                var data = this.user;
                axios.post('api/users', data)
                .then(response => {
                    // console.log(response);
                    //Clear form
                    this.user =   {
                        name: '',
                        email: '',
                        type: ''
                    }   

                    //Close
                    $('#addNewModal').modal('hide');

                    //Show                    
                    this.$toastr.s(""+response.data.message, "Success");

                    //Load users
                    this.loadUsers();

                    //Using our custom Fire Event
                    // Fire.$emit('AfterCreate');

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

            //Delete User
            deleteUser(id){               
                //Show
                Swal.fire({
                title: 'Delete?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#7BB32D',
                cancelButtonColor: '#881F1C',
                confirmButtonText: 'Yes'
                }).then((result) => {      
                    if (result.isConfirmed) {                   
                        //Show
                        this.$Progress.start();
                        //Send request to serve   
                        axios.delete('/api/users/'+id).then((response)=>{
                            // console.log(response);  
                            //Show                    
                            this.$toastr.e(""+response.data.message, "Success");
                            //Call
                            this.loadUsers();
                        });
                        //Close
                        this.$Progress.finish();
                    }
                }).catch(error => {
                    var toastr = this.$toastr;                   
                    toastr.e('Failed to delete user', "Error");
                    //Finish
                    this.$Progress.fail();
                    
                })
            }

        },

        //Mount
        mounted() {
            console.log('Component mounted.')
        },

        //Created
        created() {
            //Show
            this.$Progress.start();
            //Call
            this.loadUsers();
            //Close
            this.$Progress.finish();

            //Load users after every 3 seconds
            // setInterval(() => {                
            //     this.loadUsers();
            // }, 3000);

            //Listen to our event
            // Fire.$on('AfterCreate',  () => {                
            //     this.loadUsers();
            // }, 3000);

        }

    }
</script>

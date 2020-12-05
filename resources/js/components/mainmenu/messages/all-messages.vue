<template>
    <!-- Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                 <!-- Card -->
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Messages</h3>
                        <div class="card-tools">
                            <!-- <router-link to="create-user" class="btn btn-success btn-sm">Add New
                                <i class="fas fa-envelope fa-fw" aria-hidden="true"></i>
                            </router-link> -->
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
                                        <th>Subject</th>
                                        <th>Body</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(message, index) in messages" :key="message.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ message.name | capitalize }}</td>
                                        <td>{{ message.email }}</td>
                                        <td>{{ message.subject }}</td>
                                        <td>{{ message.body }}</td>
                                        <td>{{ message.created_at | myDate }}</td>
                                        <td>
                                            <router-link :to="'/show-feedback/' + message.id" class="btn btn-dark btn-sm">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </router-link>
                                            <button class="btn btn-danger btn-sm" @click="deleteMessage(message.id)">
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


    </div>
    <!-- ./Container -->

</template>

<script>

    export default {

        //Data
        data() {
            return { 
                messages : {},             
            }
        },

        //Method
        methods: {

            //Load
            loadMessages(){                            
                axios.get('api/feedbacks')
                .then(response => {
                    this.messages = response.data;
                    console.log(this.messages);
                });
            },

            //Delete User
            deleteMessage(id){               
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
                        //Send request to serve   
                        axios.delete('/api/feedbacks/'+id).then((response)=>{
                            // console.log(response);  
                            //Show                    
                            this.$toastr.e(""+response.data.message, "Success");
                            //Call
                            this.loadMessages();
                        });

                    }
                }).catch(error => {
                    var toastr = this.$toastr;                   
                    toastr.e('Failed to delete message', "Error");                    
                })
            }

        },

        //Mount
        mounted() {
            // console.log('Component mounted.')
        },

        //Created
        created() {
            //Call
            this.loadMessages();
        }

    }
</script>

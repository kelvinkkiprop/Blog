<template>
    <!-- Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                 <!-- Card -->
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Posts</h3>
                        <div class="card-tools">
                            <button class="btn btn-success btn-sm"  type="button"
                            data-toggle="modal" data-target="#addNewModal">Add New
                            <i class="fas fa-user-plus fa-fw" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(post, index) in posts" :key="post.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ post.title | capitalize }}</td>
                                        <th>{{ post.description }}</th>
                                        <td>{{ post.image }}</td>
                                        <td>{{post.created_at | myDate }}</td>
                                        <td>
                                            <router-link :to="'/edit-post/' + post.id" class="btn btn-dark btn-sm">
                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                            </router-link>
                                            <button class="btn btn-danger btn-sm" @click="deletePost(post.id)">
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
                posts : {},
                post: {
                    title: '',
                    description: '',
                    image: ''
                },               
            }
        },

        //Method
        methods: {

            //Load
            loadPosts(){                            
                axios.get('api/posts')
                .then(response => {
                    this.posts = response.data;
                });
            },

            //Delete Post
            deletePost(id){               
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
                        //Delete  
                        axios.delete('/api/posts/'+id).then((response)=>{
                            // console.log(response);  
                            //Show                    
                            this.$toastr.e(""+response.data.message, "Success");
                            //Call
                            this.loadPosts();
                        });
                    }
                }).catch(error => {
                    var toastr = this.$toastr;                   
                    toastr.e('Failed to delete post', "Error");                    
                })
            }

        },

        //Mount
        mounted() {
            console.log('Component mounted.')
        },

        //Created
        created() {
            //Call
            this.loadPosts();
        }

    }
</script>

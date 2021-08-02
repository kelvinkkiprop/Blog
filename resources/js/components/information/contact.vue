<template>
    <!-- Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                 <!-- Card -->
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Contact</h3>
                        <div class="card-tools">
                            <router-link to="create-info" class="btn btn-success btn-sm">Add New
                                <i class="fas fa-info-circle fa-fw" aria-hidden="true"></i>
                            </router-link>
                        </div>
                    </div>

                    <div class="card-body">

                        <div v-if="Object.keys(info).length">

                            <div class="table-responsive p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ '•' }}</td>
                                            <td>{{ info.title | capitalize }}</td>
                                            <td v-html="info.description "></td>
                                            <td>{{ info.created_at | myDate }}</td>
                                            <td class="text-nowrap">
                                                <router-link :to="'/edit-info/' + info.id" class="btn btn-dark btn-sm">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                </router-link>
                                                <button class="btn btn-danger btn-sm" @click="deleteInfo(info.id)">
                                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div v-else>
                            <p class="text-muted text-center p-5">No information found</p>
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
                info: {
                    id: '',
                    title: '',
                    description: '',
                    created_at: ''
                },
            }
        },

        //Method
        methods: {

            //Load
            loadInfo(){
                axios.get('api/information/Contact')//Hit show
                .then(response => {
                    this.info = response.data;
                    // console.log(this.info.id);
                });
            },

            //Delete Info
            deleteInfo(id){
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
                        axios.delete('/api/information/'+id).then((response)=>{
                            // console.log(response);
                            //Show
                            this.$toastr.e(""+response.data.message, "Success");
                            //Call
                            this.loadInfo();
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
            // console.log('Component mounted.')
        },

        //Created
        created() {
            //Call
            this.loadInfo();
        }

    }
</script>

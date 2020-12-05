<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">                        
                        <h3 class="card-title">Show Message</h3>
                    </div>

                    <div class="card-body">

                        <!-- Name --> 
                        <div class="form-group row">
                            <label for="name" class="col-md-4 text-md-right">Name:</label>
                            <div class="col-md-6"><span>{{ message.name }}</span></div>
                        </div>

                        <!-- Email --> 
                        <div class="form-group row">
                            <label for="email" class="col-md-4 text-md-right">Email:</label>
                            <div class="col-md-6"><span>{{ message.email }}</span></div>
                        </div>

                        <!-- Subject --> 
                        <div class="form-group row">
                            <label for="subject" class="col-md-4 text-md-right">Subject:</label>
                            <div class="col-md-6"><span>{{ message.subject }}</span></div>
                        </div>

                        <!-- Body --> 
                        <div class="form-group row">
                            <label for="body" class="col-md-4 text-md-right">Body:</label>
                            <div class="col-md-6"><span>{{ message.body }}</span></div>
                        </div>

                        <!-- Created At --> 
                        <div class="form-group row">
                            <label for="created_At" class="col-md-4 text-md-right">Created At:</label>
                            <div class="col-md-6"><span>{{ message.created_at | myDate }}</span></div>
                        </div>

                        <!-- Buttons --> 
                        <router-link to="/feedbacks" class="btn btn-outline-warning">Cancel</router-link>

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
                message: {},            
            }
        },

        //Created
         created() {
            //Id from all location tags
            var id = this.$route.params.id;
             axios.get('/api/feedbacks/'+id+'/edit').then((response)=>{
                console.log(response.data);
                this.message = response.data;
            }); 
            
        },

        //Method
        methods: {         

        }

    }
</script>
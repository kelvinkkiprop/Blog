<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">                        
                        <h3 class="card-title">Create Post</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" @submit.prevent="createPost">  

                            <!-- Category  -->                        
                            <div class="form-group">
                                <label for="category" class="col-form-label required">Category:</label>
                                <select id="category" type="text" class="form-control" name="category" 
                                v-model="post.category" autocomplete="category" autofocus required>
                                    <option value="0" disabled="true" selected="true">--- Select Category ---</option>
                                    <option v-for="category in categories" :value="category.id" :key="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>  

                            <!-- Title  -->                           
                            <div class="form-group">
                                <label for="title" class="col-form-label required">Title:</label>
                                <input id="title" type="title" class="form-control" name="name"
                                v-model="post.title" autocomplete="title" autofocus required>
                            </div> 

                            <!-- Description  -->
                            <div class="form-group">
                                <label for="description" class="col-form-label required">Description:</label>
                                <textarea id="description" type="text" class="form-control" name="description"
                                v-model="post.description" autocomplete="description" autofocus required
                                rows="3"></textarea>
                            </div> 

                            <!-- Image  -->
                            <div class="form-group">
                                <label for="image" class="col-form-label">Image:</label>
                                <input id="image" type="file" class="form-control-file" name="image"
                                autocomplete="image" @change="handleImageFieldOnChange">
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
                categories: [], 
                post: {
                    category: '',
                    title: '',
                    description: '',
                    image: ''
                },            
            }
        },

        //Created
         created() {
             axios.get('/api/post_categories').then((response)=>{
                // console.log(response.data);
                this.categories = response.data;
            });
        },

        //Method
        methods: {

            //Upload Image
            handleImageFieldOnChange(e){
            //     console.log(e.target.files[0]);
                var file = e.target.files[0];//Target file at index 0

                //Check size
                if(file['size'] < 2111775){//2MB
                    //Convert to base64
                    var reader = new FileReader();
                    reader.onloadend = (file) =>{
                        // console.log('RESULT', reader.result);
                        this.post.image = reader.result;
                    }
                    reader.readAsDataURL(file);
                    // this.post.image = file;
                    // console.log(this.post.image);
                }else{
                   this.$toastr.e('File size exceeded', "Error");  
                }

            },

            //Create
            createPost(){

                var data = this.post;
                console.log(data);
                axios.post('/api/posts', data)
                .then(response => {
                    console.log(response);
                    //Clear form
                    this.post =   {
                        category: '',
                        title: '',
                        description: '',
                        image: ''
                    }   

                    //Redirect
                    this.$router.push({ name: 'posts' })

                    //Show                    
                    this.$toastr.s(""+response.data.message, "Success");

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
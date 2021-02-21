<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-file-edit"></i> Information</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" @submit.prevent="updateInfo(info.id)">

                            <!-- Title  -->
                            <div class="form-group">
                                <label for="title" class="col-form-label required">Title:</label>
                                <select id="title" type="text" class="form-control" name="title"
                                v-model="info.title" autocomplete="title" autofocus required>
                                    <option value="0" disabled="true" selected="true">--- Select Title ---</option>
                                    <option v-for="title in titles" :value="title.name" :key="title.id">
                                        {{ title.name }}
                                    </option>
                                </select>
                            </div>

                            <!-- Description  -->
                            <div class="form-group">
                                <label for="description" class="col-form-label required">Description:</label>
                                <vue-editor id="description" v-model="info.description"></vue-editor>
                            </div>

                            <!-- Buttons -->
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-outline-warning" @click="$router.go(-1)">Cancel</button>

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
                titles: [],
                info: {
                    title: '',
                    description: '',
                },
            }
        },

        //Created
         created() {
             //Set
            this.titles =[ { id:1, name: 'About'}, {id:2, name: 'Contact'}, {id:3, name: 'Services'}];

            //Get ID
            this.id = this.$route.params.id;
            var id = this.id;
            // console.log('This is my id from vue router'+uid);
            axios.get('/api/information/'+id+'/edit').then((response)=>{
                // this.users = response.data;
                this.info = response.data;
            });

        },

        //Method
        methods: {
            //Create
            updateInfo(id){

                var data = this.info;
                // console.log(data);
                axios.put('/api/information/'+id, data)
                .then(response => {
                    // console.log(response);
                    //Clear form
                    this.info =   {
                        title: '',
                        description: '',
                    }

                    //Redirect
                    this.$router.go(-1); //Back 1 step

                    //Show
                    this.$toastr.i(""+response.data.message, "Success");

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

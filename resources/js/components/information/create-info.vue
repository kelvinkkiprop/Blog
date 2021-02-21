<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Information</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" @submit.prevent="createInfo">

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

            // console.log(this.categories);
        },

        //Method
        methods: {
            //Create
            createInfo(){

                var data = this.info;
                // console.log(data);
                axios.post('/api/information', data)
                .then(response => {
                    console.log(response);
                    //Clear form
                    this.info =   {
                        title: '',
                        description: '',
                    }

                    //Redirect
                    this.$router.go(-1); //Back 1 step

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

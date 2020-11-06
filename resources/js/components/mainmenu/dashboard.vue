<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">                        
                        <h3 class="card-title">System Insights</h3>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ post_categories }}</h3>
                                        <p>Post Categories</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More Info</a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ posts }}</h3>
                                        <p>Posts</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-android-list"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info</a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ users }}</h3>
                                        <p>Users</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-android-people"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info</a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                    <h3>{{ visits }}</h3>
                                    <p>Visits</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">                        
                        <h3 class="card-title">Recent Users</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in latest_users" :key="user.id">
                                        <td>{{ user.name | capitalize }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.created_at | myDate }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                        
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
                post_categories: '',
                posts : '', 
                users : '', 
                visits : '',
                latest_users : {},              
            }
        },

        //Methods
        methods: {
            //Load
            loadInsights(){                            
                axios.get('api/insights')
                .then(response => {
                    this.post_categories = response.data.post_categories_count;
                    this.posts = response.data.posts_count;
                    this.users = response.data.users_count;
                    this.visits = response.data.visits_count;
                    this.latest_users = response.data.recent_users;
                });
            },
        },

        //Mounted
        mounted() {
            // console.log('Component mounted.')
        },

        //Created
        created() {
            //Call
            this.loadInsights();
        }
    }
</script>

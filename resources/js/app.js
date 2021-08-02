/**
 * Load all of this project's JavaScript dependencies which includes Vue and other libraries
 */

 /**
 * Load Bootstrap
 */
require('./bootstrap');

/**
 * Load Vue
 */
window.Vue = require('vue');


/**
 * Import moment
 */
import moment from 'moment';


/**
 * Import vue router
 */
import VueRouter from 'vue-router'
Vue.use(VueRouter)

/**
 * Import vue Toastr
 */
import VueToastr from "vue-toastr"
Vue.use(VueToastr)


/**
 * Import Sweet Alert
 */
import swal from 'sweetalert2';
window.Swal = swal


/**
 * Import VueEditor
 */
import VueEditor from "vue2-editor";
Vue.use(VueEditor)


/**
* Vue Global Filter to Format Date
*/
Vue.filter('myDate', function (value) {
 if (!value) return ''
 return moment(value).format("Do MMM, YYYY")
})

/**
 * Vue Global Filter to Capitilize
 */
Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
})


/**
 * Register your Vue components.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);



/**
 * Define some routes
 */
const routes = [
    //Dashboard
    { path: '/dashboard', name:'dashboard', component: require('./components/mainmenu/dashboard.vue').default },

    //Posts
    { path: '/posts', name:'posts', component: require('./components/mainmenu/posts/all-posts.vue').default },
    { path: '/create-post', name:'create-post',component: require('./components/MainMenu/posts/create-post.vue').default },
    { path: '/edit-post/:id', name:'edit-post', component: require('./components/MainMenu/posts/edit-post.vue').default },

    //Messages
    { path: '/feedbacks', name:'feedbacks', component: require('./components/mainmenu/messages/all-messages.vue').default },
    { path: '/show-feedback/:id', name:'show-feedback', component: require('./components/mainmenu/messages/show-message.vue').default },

    //Users
    { path: '/users', name:'users', component: require('./components/mainmenu/users/all-users.vue').default },
    { path: '/create-user', name:'create-user', component: require('./components/MainMenu/users/create-user.vue').default },
    { path: '/edit-user/:id', name:'edit-user', component: require('./components/MainMenu/users/edit-user.vue').default },

    //Information
    { path: '/about-admin', name:'about-admin', component: require('./components/information/about.vue').default },
    { path: '/create-info', name:'create-info', component: require('./components/information/create-info.vue').default },
    { path: '/edit-info/:id', name:'edit-user', component: require('./components/information/edit-info.vue').default },
    { path: '/services-admin', name:'about-admin', component: require('./components/information/services.vue').default },
    { path: '/contact-admin', name:'about-admin', component: require('./components/information/contact.vue').default },

  ]


/**
 * Create the router instance and pass the `routes` option
 */
const router = new VueRouter({
    mode: 'history',//Gets rid of the hash to detect active menu
    routes // short for `routes: routes`
})


/**
 * Create a fresh Vue application instance and attach it to the page
 */

const app = new Vue({
    el: '#adminLTE',
    router //Call routes
});



/*--------------------------------------GETUSERLOCATION------------------------------------------*/
//Request access to user location
window.navigator.geolocation.getCurrentPosition(
    function(position){
        $.ajax({
            url: "https://geolocation-db.com/jsonp",
            jsonpCallback: "callback",
            dataType: "jsonp",
            success: function(location) {

                // console.log(location);
                // console.log(location.country_code);
                // console.log(location.country_name);
                // console.log(location.state);
                // console.log(location.city);
                // console.log(location.postal);
                // console.log(location.latitude);
                // console.log(location.longitude);
                // console.log(location.IPv4);

                //Use axios
                axios.post('/api/save-visitor', location)
                .then((response) => {
                    // console.log(response);

                }).catch((error) => {
                    // console.log(error);
                });


            }

        });
    },
    function(error){
        //User failed to share location
        // console.log("Error "+error.message);
    });
/*--------------------------------------./GETUSERLOCATION------------------------------------------*/


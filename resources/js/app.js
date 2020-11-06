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

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);



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

    //Users
    { path: '/users', name:'users', component: require('./components/mainmenu/users/all-users.vue').default },
    { path: '/create-user', name:'create-user', component: require('./components/MainMenu/users/create-user.vue').default },
    { path: '/edit-user/:id', name:'edit-user', component: require('./components/MainMenu/users/edit-user.vue').default },

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

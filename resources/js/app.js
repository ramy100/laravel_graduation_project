require('./bootstrap');
window.Pusher = require('pusher-js');
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');

var notifications = [];

const NOTIFICATION_TYPES = {
    Payment: 'App\\Notifications\\designerNotifications',
    User: 'App\\Notifications\\UserNotifications'
};
        
        import Echo from "laravel-echo";

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key:'f6281f4e9f8d2a800dd2',
            cluster: 'eu',
            encrypted: false
        });
        // var notifications = [];
        // $(document).ready(function(){
        //     window.Echo.private(`App.User.${Laravel.userId}`)
        //     .notification((notification) => {
        //        alert(notification);
        //     });
        // });
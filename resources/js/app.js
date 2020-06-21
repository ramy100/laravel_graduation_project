require('./bootstrap');
window.Pusher = require('pusher-js');
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');

var notifications = [];
const NOTIFICATION_TYPES = {
    Payment: 'App\\Notifications\\designerNotifications',
    
    User: 'App\\Notifications\\UserNotifications',

    CompanyUser: 'App\\Notifications\\CompanyUserNotifications'
};
        
        import Echo from "laravel-echo";

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key:'934f94342496700052a5',
            cluster: 'eu',
            // key:process.env.MIX_PUSHER_APP_KEY,
            // cluster: process.env.MIX_PUSHER_APP_CLUSTER,
            encrypted: false
        });

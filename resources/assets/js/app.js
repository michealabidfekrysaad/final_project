window.Pusher = require('pusher-js');
import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '0eff3995fff2788e3d11',
    cluster: 'eu',
    encrypted: true
});

var notifications = [];

//...

$(document).ready(function () {
    if (Laravel.userId) {
        //...
        window.Echo.private(`App.User.${Laravel.userId}`)
            .notification((notification) => {
                addNotifications([notification], '#notifications');
            });
    }
});

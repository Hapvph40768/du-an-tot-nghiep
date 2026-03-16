import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "7bd01360a41ef9c3019c",
    cluster: "ap1",
    forceTLS: true
});
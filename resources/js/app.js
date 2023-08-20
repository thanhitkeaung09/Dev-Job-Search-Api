// import axios from 'axios';
import './bootstrap';

// alert("websocket")
// import Echo from 'laravel-echo';
let publicChannel = Echo.channel("noti");
publicChannel.subscribed(()=>{
    console.log("subscribed");
}).listen(".server.noti.send", (event) => {
        console.log(event);
     });

// let publicChannel = Echo.channel("noti");
// publicChannel
//     .subscribed(() => {
//         console.log("publicChannel subscribed");
//     })
//     // .listen(".server.message.like", (event) => {
//     //     console.log(event);
//     // });

// const send = document.getElementById("send");



// submit event is ok
send.addEventListener("click",()=>{
    console.log("helo");
    axios.get("/user/like/list",{
        message : "hello"
    })
})
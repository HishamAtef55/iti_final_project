/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";

// import { createApp } from "vue";

import { createApp } from "vue";

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

// const app = createApp({});

HEAD;
// import ExampleComponent from "./components/ExampleComponent.vue";
// app.component("example-component", ExampleComponent);

import ExampleComponent from "./components/ExampleComponent.vue";
app.component("example-component", ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
/*Echo.channel("notifies").listen("NotifEvent", (e) =>
    console.log("real" + e.message)
);
*/
Echo.private("App.Models.User.9").notification((notification) => {
    document.body.innerHTML += `
     <div id="testn" data-mdb-delay="2000" style="    position: fixed;
     top: 57%; right: 10%; background-color:#fbf0da;
     padding: 15px 50px; text-align: center;
     border: 1px solid #fbf0da;  border-radius: 5px; color: #73510d;
     display: block; font-weight: 500; font-size: 17px;"
    >
        ${notification.message}
    </div>`;
    $("#testn").delay(3000).fadeOut(1000);
});

// app.mount("#app");

var x = document.getElementById("message_send");
const username_input = document.getElementById("username");
const message_input = document.getElementById("message_input");
x.addEventListener("click", function (e) {
    console.log("helo");
    e.preventDefault();

    // e.preventDefault();
    let has_Error = false;
    if (has_Error) {
        return;
    }
    const options = {
        method: "post",
        url: "/send-message",
        date: {
            username: username_input.value,
            message: message_input.value,
        },
        transformResponse: [
            (data) => {
                return data;
            },
        ],
    };
    axios(options);
});
window.Echo.channel("chat").listen(".message", (e) => {
    console.log(e);
});

app.mount("#app");
/*Echo.private(`orders.${orderId}`).listen("OrderShipmentStatusUpdated", (e) => {
    console.log(e.order);
});*/

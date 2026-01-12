// Import Firebase modules
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

// Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyC5YfSaBGQ4wNpKA82IOBtV1Q2-juAr8EE",
    authDomain: "sparklem-management.firebaseapp.com",
    projectId: "sparklem-management",
    storageBucket: "sparklem-management.firebasestorage.app",
    messagingSenderId: "858863366626",
    appId: "1:858863366626:web:4073a2909f2038ac4949bb",
    measurementId: "G-SGC8YBNVCS",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);


function playAudio() {
    var audio = new Audio('/happy-bell-notification.wav');
    console.log(audio);
    audio.play();
  }

// Alpine.js-compatible Firebase handler
const firebaseHandler = () => ({
    deviceToken: "",

    notificationPermission:false,

    init(){
       
        this.requestPermission();
     },

    requestPermission(){
        if ("Notification" in window) {
            // Request notification permission
            Notification.requestPermission().then((permission)=>{
                if (permission === "granted") {
                    this.notificationPermission = true;
                    this.getToken();
                } else if (permission === "denied") {
                    console.log("Notification permission denied.");
                } else {
                    console.log("Notification permission request was dismissed.");
                }
            });
        } else {
            console.log("This browser does not support notifications.");
        }
    },
    async getToken() {
        try {
            // Replace "your-vapid-public-key" with your actual VAPID key
            const vapidKey = "BAG3h0uJp2_kakuaD4Qkg1fFIwD2-Ehd9485cz5Vhiw-QT_OvmzjIXKLSiIaqx5l-V1ak6_9he9peF9CQJuKjN0";
            const currentToken = await getToken(messaging, { vapidKey });

            if (currentToken) {
                this.deviceToken = currentToken;
                this.$refs.token.value = this.deviceToken;
                this.$refs.token.dispatchEvent(new Event("input"));
                console.log("Device Token:",this.deviceToken);
            } else {
                console.warn(
                    "No registration token available. Request permission to generate one."
                );
            }
        } catch (error) {
            console.error("An error occurred while retrieving token:", error);
        }
    },
});

// Make the handler globally available
window.firebaseHandler = firebaseHandler;

// Handle foreground notifications
onMessage(messaging, (payload) => {
    console.log("Message received: ", payload);

    Livewire.dispatch('notification-received');
    // Show a notification or handle the payload as needed
    playAudio();
});

if ("serviceWorker" in navigator) {
    navigator.serviceWorker
        .register("/firebase-messaging-sw.js")
        .then((registration) => {
            console.log("Service Worker registered successfully with scope:", registration.scope);
        })
        .catch((err) => {
            console.error("Service Worker registration failed:", err);
        });
}

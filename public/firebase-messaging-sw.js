importScripts(
  "https://www.gstatic.com/firebasejs/9.14.0/firebase-app-compat.js"
);
importScripts(
  "https://www.gstatic.com/firebasejs/9.14.0/firebase-messaging-compat.js"
);
self.addEventListener('notificationclick', function (event) {
  console.log('SW notification click event', event);

  // Close the notification
  event.notification.close();

  // Get the URL from the notification data
  const url = event.notification.data.FCM_MSG.data.click_action;

  event.waitUntil(
    clients.matchAll({type: 'window'}).then(windowClients => {
      let matchingClient = null;

      // Check if there is already a window/tab open with the same domain
      for (let i = 0; i < windowClients.length; i++) {
        const client = windowClients[i];
        const clientUrl = new URL(client.url);
        const targetUrl = new URL(url);

        // Compare domains
        if (clientUrl.hostname === targetUrl.hostname) {
          matchingClient = client;
          break;
        }
      }

      // If we found a matching client, focus on it
      if (matchingClient) {
        matchingClient.navigate(url); 
        console.log('navigating to',url)
      } else {
        // If no matching client, open the URL in a new tab
        clients.openWindow(url).then((client) => {
          if (client && 'focus' in client) {
            client.focus();
          }
        });
      }
    })
  );
});



// Initialize Firebase app in the service worker
firebase.initializeApp({
  apiKey: "AIzaSyC5YfSaBGQ4wNpKA82IOBtV1Q2-juAr8EE",
  authDomain: "sparklem-management.firebaseapp.com",
  projectId: "sparklem-management",
  storageBucket: "sparklem-management.firebasestorage.app",
  messagingSenderId: "858863366626",
  appId: "1:858863366626:web:4073a2909f2038ac4949bb",
  measurementId: "G-SGC8YBNVCS",
});

// Retrieve an instance of Firebase Messaging so that it can handle background messages
const messaging = firebase.messaging();

// Foreground message handler
messaging.onMessage(function(payload) {
  console.log("[firebase-messaging-sw.js] Received foreground message ", payload);

  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: payload.notification.icon,
    sound: '/happy-bell-notification.wav',
    badge:'/favicon.ico',
    vibrate: true,
    data: {
      FCM_MSG: payload.data,
    }
  };

  //return self.registration.showNotification(notificationTitle, notificationOptions);
});

// Background message handler
messaging.onBackgroundMessage((payload) => {
  console.log("[firebase-messaging-sw.js] Received background message ", payload);
  playAudio();
  
  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: payload.notification.icon,
    sound: '/happy-bell-notification.wav',
<<<<<<< HEAD
    badge:'/favicon.ico',
=======
    badge: payload.data.badge || '/badge.png',
>>>>>>> 23b7c913af3dee6b48396a19608f4a09172f8f6f
    vibrate: true,
    data: {
      FCM_MSG: payload.data,
    }
  };

  return self.registration.showNotification(notificationTitle, notificationOptions);
});

function playAudio() {
  var audio = new Audio('/happy-bell-notification.wav');
  audio.play();
}

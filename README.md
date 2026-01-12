

# Team Management App (v1)

A production-ready **Team Management System** built with **Laravel**, designed for managing teams, users, attendance/check-ins, and push notifications using **Firebase Cloud Messaging (FCM)**.

This application is configured for database-backed sessions, queues, and caching, making it suitable for real-world internal team operations.

---

## 🚀 Features

### ✅ Core Features

*  user management
*  Onboarning
*  task,attendence and leave management
*  event management

### ⏱ Attendance / Check-in Logic

* Configurable daily check-in time limit
* Late check-in handling via environment configuration

```env
CHECKIN_TIME_LIMIT=11:06
```

### 🔔 Push Notifications (FCM)

* Firebase Cloud Messaging (FCM) integration
* Server-side notification triggering
* Firebase credentials stored securely in server storage

```env
FIREBASE_CREDENTIALS=storage/app/firebase-auth.json
```

### 🧠 Background Processing

* Database queue driver
* Asynchronous job handling
* Notification & background task support


---

## 🧱 Tech Stack

**Backend**

* PHP 8+
* Laravel
* MySQL

**Frontend**

* Blade templates
* Tailwind CSS
* Vite


---

## 🛠 Installation & Setup

###  Clone the Repository

```bash
git clone https://github.com/joydeep-bhowmik/team-management-app-v1.git
cd team-management-app-v1
```

---

###  Install Dependencies

```bash
composer install
npm install
```

---

###  Environment Configuration

Create your `.env` file:

```bash
cp .env.example .env
```

Configure the following **required values**:

```env
APP_NAME=team-management-app
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

Generate the app key:

```bash
php artisan key:generate
```

---

###  Firebase Cloud Messaging Setup

1. Create a Firebase project
2. Enable Cloud Messaging
3. Download the service account JSON
4. Place it at:

```
storage/app/firebase-auth.json
```

5. Update `.env`:

```env
FIREBASE_CREDENTIALS=storage/app/firebase-auth.json
```

---


### Build Frontend Assets

```bash
npm run dev
```

or for production:

```bash
npm run build
```

---

### 7. Run the Application

```bash
php artisan serve
```

Access the app at:

```
http://127.0.0.1:8000
```

---



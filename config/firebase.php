<?php

declare (strict_types = 1);

return [
    /*
     * ------------------------------------------------------------------------
     * Default Firebase project
     * ------------------------------------------------------------------------
     */

    'default' => env('FIREBASE_PROJECT', 'app'),

    /*
     * ------------------------------------------------------------------------
     * Firebase project configurations
     * ------------------------------------------------------------------------
     */

    'projects' => [
        'app' => [

            /*
             * ------------------------------------------------------------------------
             * Credentials / Service Account
             * ------------------------------------------------------------------------
             *
             * In order to access a Firebase project and its related services using a
             * server SDK, requests must be authenticated. For server-to-server
             * communication this is done with a Service Account.
             *
             * If you don't already have generated a Service Account, you can do so by
             * following the instructions from the official documentation pages at
             *
             * https://firebase.google.com/docs/admin/setup#initialize_the_sdk
             *
             * Once you have downloaded the Service Account JSON file, you can use it
             * to configure the package.
             *
             * If you don't provide credentials, the Firebase Admin SDK will try to
             * auto-discover them
             *
             * - by checking the environment variable FIREBASE_CREDENTIALS
             * - by checking the environment variable GOOGLE_APPLICATION_CREDENTIALS
             * - by trying to find Google's well known file
             * - by checking if the application is running on GCE/GCP
             *
             * If no credentials file can be found, an exception will be thrown the
             * first time you try to access a component of the Firebase Admin SDK.
             *
             */

            'credentials' => [
                "type" => "service_account",
                "project_id" => "sparklem-management",
                "private_key_id" => "a6cfdc9f1558c8474d21bac30380a888f8f0fe0f",
                "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCcwMvJduR8wjVn\n9GNy77GT8Hr4P1LiA2RsimuM7WpYSsygKWzlU2potAFM4ppaLHwac2bYp+Vcci0D\nMvQOsLtVz5nz2lewFLjIx6VFIRc/LwVV/HDPpkk/6jM3SwnyMElP/0N5jJzG3Jzu\nfbTE/yAJKIdZseZCfVJrI87jVffB84tE6Nq49LvSjxqwvy7PpUaFsMiiKV+EXdU2\n4N+oi3o5ybUx0Jic7a4eLqA07uRF8d0AynIiuryVZBZa7scMMUSpb4z3t1jVxKSi\nrCk0KGyIxdsSYiNO3eHRV4Sa8jRzqOag5FgWBz+P+SLif/zxAvYU/y7OB3/U4AfD\naLHOVpbNAgMBAAECggEAGUrYdujapDC36k6aD00So5K9XLnm9zXh6cuJ4ALc0mM7\nUips+jGz7TICNbQogJ1F5wSw1wt8LCb2EVqS253zlDx7lEeqN2yYhjkEdzuIIzdE\njqO9Vhv4HLp+yhCvCad15NUEv6OLFmE5ZxfcZ57cve2OrU/Rne/XsRblhnP0FpSj\nQDtv1d1j9HlADwJNZdv9FK00LncRPLuUfLdpbts5QK5/YBfnXsFULTaUISQRdGnL\nnKW0e3BstzszGMcp/863oAiIARNr9oErjsPIu5vsMvch782DC6Zl0eofqxKcAKAt\ndecseeFNOKR6sWTfckd5/imuiHMYk1ARkx6Po+pRRwKBgQDLkQq8RlJplH+OCQ3e\n2945Cuy6mREZdKDSTKo8DNndp7OpV0sDE4Tq2AhBy95UvvlL/DagwAHxdulFKEzu\nD+sZHdsZiWfe+3h5vZTXxqVN+7iDwDKQaJ17KMV8FkyIcvm63WhDD7xrqd+NQ6cH\nWX59J2frD/ck3VSbV42IXv16+wKBgQDFIOzr1MjkDsBDef0ywIeKk5XhFkt+0yKT\nYEKFrdvnBCRBdm8t7gFzpiUsm1emCs7grfk3Bj66G7vrejZjcD4x3q+sWBaVXkVK\nZ5tLY+KhE9c/gDJWXEXP/0bpAVFWXn2Qcpk7n/QPP73fOC/WfdI/+P06nMXscTE5\nC3z4QSuK1wKBgQCbvDj0VPBTqbH0HeUorBjUlxEIqHW2fc1TVieejU5YDyaZ1Rik\nH9i+OcwHWkqblwbuJOQ+EubprklECVLhhfgcXQT0AnUe2FARAwLOGUD56iv9T5rf\nc8mXIVgEWKLweNWpKh3LwEwsKefHEQzFyKfGY9FSugIfh9xkg5TZ0aIm5QKBgHp3\ncRk2MbQVQfbps5azK8G43LVgz3g0HVfnxowcLfDAjvGobXvgUECT6KZkv7glIM9O\n5fP8Sj3++ulZHK78TXdX/FWayDT1wyBta3oTzPj7RY9qylsCqlCFLH2XVvvMaj+y\nImZ7gflzRTeHRZkAw/0AZ/ng6clxrP3emD325uEzAoGBAIW1RUnALZdVtTpwn8vY\ncmHBANZ8H3t4QMZXu/vY7sghIRj2X3ET8bpZkIzRoqAXySVb1HDiq93VvSL+qsnD\nOlvBJ0APwjf1ifpKpIDUlnFJZp40RR4PEH25UGN/jU41ZP0bcqpFZw0C//w1wtZF\ne8+Lqmobbdg+GaotdyP8urDD\n-----END PRIVATE KEY-----\n",
                "client_email" => "firebase-adminsdk-axpl2@sparklem-management.iam.gserviceaccount.com",
                "client_id" => "109557208032580513646",
                "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                "token_uri" => "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-axpl2%40sparklem-management.iam.gserviceaccount.com",
                "universe_domain" => "googleapis.com",
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Auth Component
             * ------------------------------------------------------------------------
             */

            'auth' => [
                'tenant_id' => env('FIREBASE_AUTH_TENANT_ID'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firestore Component
             * ------------------------------------------------------------------------
             */

            'firestore' => [

                /*
                 * If you want to access a Firestore database other than the default database,
                 * enter its name here.
                 *
                 * By default, the Firestore client will connect to the `(default)` database.
                 *
                 * https://firebase.google.com/docs/firestore/manage-databases
                 */

                // 'database' => env('FIREBASE_FIRESTORE_DATABASE'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Realtime Database
             * ------------------------------------------------------------------------
             */

            'database' => [

                /*
                 * In most of the cases the project ID defined in the credentials file
                 * determines the URL of your project's Realtime Database. If the
                 * connection to the Realtime Database fails, you can override
                 * its URL with the value you see at
                 *
                 * https://console.firebase.google.com/u/1/project/_/database
                 *
                 * Please make sure that you use a full URL like, for example,
                 * https://my-project-id.firebaseio.com
                 */

                'url' => env('FIREBASE_DATABASE_URL'),

                /*
                 * As a best practice, a service should have access to only the resources it needs.
                 * To get more fine-grained control over the resources a Firebase app instance can access,
                 * use a unique identifier in your Security Rules to represent your service.
                 *
                 * https://firebase.google.com/docs/database/admin/start#authenticate-with-limited-privileges
                 */

                // 'auth_variable_override' => [
                //     'uid' => 'my-service-worker'
                // ],

            ],

            'dynamic_links' => [

                /*
                 * Dynamic links can be built with any URL prefix registered on
                 *
                 * https://console.firebase.google.com/u/1/project/_/durablelinks/links/
                 *
                 * You can define one of those domains as the default for new Dynamic
                 * Links created within your project.
                 *
                 * The value must be a valid domain, for example,
                 * https://example.page.link
                 */

                'default_domain' => env('FIREBASE_DYNAMIC_LINKS_DEFAULT_DOMAIN'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Cloud Storage
             * ------------------------------------------------------------------------
             */

            'storage' => [

                /*
                 * Your project's default storage bucket usually uses the project ID
                 * as its name. If you have multiple storage buckets and want to
                 * use another one as the default for your application, you can
                 * override it here.
                 */

                'default_bucket' => env('FIREBASE_STORAGE_DEFAULT_BUCKET'),

            ],

            /*
             * ------------------------------------------------------------------------
             * Caching
             * ------------------------------------------------------------------------
             *
             * The Firebase Admin SDK can cache some data returned from the Firebase
             * API, for example Google's public keys used to verify ID tokens.
             *
             */

            'cache_store' => env('FIREBASE_CACHE_STORE', 'file'),

            /*
             * ------------------------------------------------------------------------
             * Logging
             * ------------------------------------------------------------------------
             *
             * Enable logging of HTTP interaction for insights and/or debugging.
             *
             * Log channels are defined in config/logging.php
             *
             * Successful HTTP messages are logged with the log level 'info'.
             * Failed HTTP messages are logged with the log level 'notice'.
             *
             * Note: Using the same channel for simple and debug logs will result in
             * two entries per request and response.
             */

            'logging' => [
                'http_log_channel' => env('FIREBASE_HTTP_LOG_CHANNEL'),
                'http_debug_log_channel' => env('FIREBASE_HTTP_DEBUG_LOG_CHANNEL'),
            ],

            /*
             * ------------------------------------------------------------------------
             * HTTP Client Options
             * ------------------------------------------------------------------------
             *
             * Behavior of the HTTP Client performing the API requests
             */

            'http_client_options' => [

                /*
                 * Use a proxy that all API requests should be passed through.
                 * (default: none)
                 */

                'proxy' => env('FIREBASE_HTTP_CLIENT_PROXY'),

                /*
                 * Set the maximum amount of seconds (float) that can pass before
                 * a request is considered timed out
                 *
                 * The default time out can be reviewed at
                 * https://github.com/kreait/firebase-php/blob/6.x/src/Firebase/Http/HttpClientOptions.php
                 */

                'timeout' => env('FIREBASE_HTTP_CLIENT_TIMEOUT'),

                'guzzle_middlewares' => [],
            ],
        ],
    ],
];

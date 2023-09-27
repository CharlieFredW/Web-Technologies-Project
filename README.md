# Web-Technologies-Project
Music Sampler Library

Music Sampler Library is a web application that give users the ability to record their own samples and upload them to their profile and then share them if they want to. The samples will then, if the samples are uploaded/shared to the platform, give other users the ability to search the sites by using filters, for specific samples, or the music scale key of samples and so on, and then download them. Kind of like the attached picture. The user can make the samples private, public or maybe friends only. In the start we will only simulate that files are uploaded, if there is time the upload samples function will be implemented.

To get docker running with Laravel:

- If not mac user or you dont have the right vendor folder. Download that from google.drive.
- If ou do not have the right .env file copy paste the one below and put in folder.
- To start the docker container run './vendor/bin/sail up'

*/
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:9B43aqRcXyUnjDLMdGicBLCFrb4kDzsf2X8yu/3vrQ8=
APP_DEBUG=true
APP_URL=http://webtechnologilaravel.test

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=webtechnologilaravel
DB_USERNAME=sail
DB_PASSWORD=password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=http://meilisearch:7700

MEILISEARCH_NO_ANALYTICS=false
*/






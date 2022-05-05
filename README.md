# laravel-soketi-broadcast-examole-by-websoket
## How to use
Run this program as follows:
```
$ git clone https://github.com/lechatthecat/laravel-soketi-broadcast-examole-by-websoket
$ cd laravel-soketi-broadcast-examole-by-websoket
$ docker-compose up -d --build
$ docker-compose exec laravel ash
# In the laravel container:
$ sh -x /laravel_build.sh
$ npm run watch
```
Then see http://localhost:8080  
You can see laravel is working on docker there.  
This page is now subscribing to "testchannel".  
  
Now you can broadcast a "TestEvent" by artisan command.  
**Open a new terminal**, then run these commands:
```
$ docker-compose exec laravel ash
# In the laravel container:
$ sh -x /laravel_build.sh
$ php artisan push:notice
```
Now you can see "TestEvent" is pushed to all clients who are "testchannel".

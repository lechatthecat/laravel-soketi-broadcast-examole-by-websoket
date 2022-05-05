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

### Why soketi for websocket?
laravel-websoket ... soketi works faster and has better scalability (as of May 2022)  
ratchet ... [ratchet doesn't support wamp v2](https://github.com/ratchetphp/Ratchet/issues/168#issuecomment-55339203), so you must find a client that supports wamp v1, or use [ocpp1.6](https://github.com/ratchetphp/Ratchet/issues/717). (as of May 2022)  
Thruway ... This supports wamp v2, and it seems it is working good, but I feel documentation is not enough. (as of May 2022)  
  

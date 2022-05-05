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
That page is now subscribing to "testchannel" by websocket.  
  
Now you can broadcast a "TestEvent" by artisan command.  
**Open a new terminal**, then run these commands:
```
$ docker-compose exec laravel ash
# In the laravel container:
$ php artisan push:notice
```
Now you can see that "TestEvent" is pushed to all clients who are subscribing to "testchannel".

### Why soketi for websocket?
laravel-websoket ... soketi works faster and has better scalability (as of May 2022)  
ratchet ... [ratchet doesn't support wamp v2](https://github.com/ratchetphp/Ratchet/issues/168#issuecomment-55339203), so you must find a client that supports wamp v1, or use [ocpp1.6](https://github.com/ratchetphp/Ratchet/issues/717). (as of May 2022)  
Thruway ... This supports wamp v2, and it seems it is working good, but I feel documentation is not enough. (as of May 2022)  

### Notice
Though I may update later, this project is using "sync" for its queue backend.  
This is because this project is using redis cluster and [queue with redis cluster is a bit complicated](https://stackoverflow.com/questions/41091103/laravel-predis-redis-cluster-moved-no-connection-to-127-0-0-16379).  
Depending on your situation, you may need to change the queue backend to "redis", DB or other choices.

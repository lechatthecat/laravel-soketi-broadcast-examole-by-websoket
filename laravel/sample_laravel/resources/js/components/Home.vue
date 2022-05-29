<template>
    <div class="container">
        <div id="chat-page">
            <div class="chat-container">
                <div class="chat-header">
                    <h2>Sever Side Events Demo</h2>
                </div>
                <ul id="messageArea" class="messageArea">
                    <li v-for="message in receivedMessages" :key="message.id">
                        {{message.message}}
                    </li>
                </ul>
                <form id="messageForm" name="messageForm">
                    <div class="form-group">
                        <div class="input-group clearfix">
                            <!-- <input v-model="textareaValue" type="text" id="message" placeholder="Type a message..." autocomplete="off" class="form-control"/> -->
                            <!-- <input @click="send" class="primary" type="button" value="Send"> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
          data () {
            return {
                receivedMessages: [],
                reconnectFrequencyMilliseconds: 5000,
                evtSource: null,
            }
        },
        mounted() {
            this.setupEventSource();
        },
        methods: {
            setupEventSource() {
                // 古いブラウザーのサポートのためにはEventSourceはpollyfillが必要
                this.evtSource = new EventSource('/api/stream');
                this.evtSource.addEventListener('ping', event => {
                    JSON.parse(event.data).forEach(message => {
                        this.receivedMessages.push(message);
                    });
                });
                this.evtSource.onopen = () => {
                    console.log("Opened.");
                };
                this.evtSource.onmessage = (e) => {
                    console.log(e);
                };
                this.evtSource.onerror = (e) => {
                    // console.error(e);
                    // 正常にステータス200で結果がAPIから返却された場合もエラーイベントが発火する
                    // https://stackoverflow.com/questions/47179556/why-am-i-seeing-unspecified-sse-errors-using-js-server-sent-events-with-php
                    this.evtSource.close();
                    this.reconnectFunc();
                };
            },
            async reconnectFunc () {
                console.log("Trying to reconnect.");
                await new Promise(resolve => setTimeout(resolve, 5000));
                setTimeout(this.setupEventSource(), this.reconnectFrequencyMilliseconds) 
            },
        }
    }
</script>
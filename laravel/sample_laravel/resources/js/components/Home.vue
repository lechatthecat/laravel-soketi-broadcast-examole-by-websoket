<template>
    <div class="container">
        <div id="chat-page">
            <div class="chat-container">
                <div class="chat-header">
                    <h2>WebSocket Demo</h2>
                </div>
                <ul id="messageArea" class="messageArea">
                    <li v-for="msg in messageReceived" :key="msg.id">
                        {{msg.message}}
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
                num: 0,
                messageReceived: [],
            }
        },
        mounted() {
            // main.js
            console.log("################1");
            Echo.subscribe(`testchannel`)
                .bind('TestEvent', (e) => {
                    console.log(e);
                    this.num = this.num + 1;
                    e['id'] = this.num;
                    this.messageReceived.push(e);
                });
        },
        methods: {
            send (event) {
                // const message = this.textareaValue.trim();
                // Echo.channel(`testchannel`).whisper('send', {
                //     message : message,
                // });
            }
        }
    }
</script>

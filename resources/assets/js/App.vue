<template>
  <chat-app 
    :messages="messages"
    :channels="channels"
    :current-channel="currentChannel"
    @new-message="newMessage"
    @new-channel="newChannel"
    @join-channel="joinChannel"
  ></chat-app>
</template>

<script>
    import ChatApp from './components/ChatApp.vue';
    import {getChannels, sendMessage, createChannel} from './api/Chat';

    export default {
        components: {
            ChatApp
        },
        data () {
            return {
            messages: [],
            channels: [],
            currentChannel: null,
            };
        },
        methods: {
            newMessage (message) {
                sendMessage(this.currentChannel, message);
            },
            newChannel (channelName) {
                createChannel(channelName);
            },
            joinChannel (channel) {
                if (this.currentChannel && this.currentChannel.id === channel.id) {
                    return;
                }

                if (this.currentChannel) {
                    Echo.leave(`channels.${this.currentChannel.id}`);
                }

                try {
                    Echo.private(`channels.${channel.id}`)
                        .listen('NewMessage', (e) => {
                            this.messages.push(e);
                        });

                    this.currentChannel = channel;
                    this.messages = [];
                } catch (e) {
                    console.log(e);
                }
            }
        },
        mounted () {
            getChannels()
                .then((channels) => {
                    this.channels = channels;
                });

            Echo.private(`companies.${window.Laravel.company.id}`)
                .listen('ChannelCreated', (e) => {
                    this.channels.push(e.channel);
                });
        }
    }
</script>


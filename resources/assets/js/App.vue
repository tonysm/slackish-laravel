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
    
    import {SEND_NEW_MESSAGE, CREATE_NEW_CHANNEL, LIST_CHANNELS} from './store/actions';
    import {NEW_CHANNEL, NEW_MESSAGE, JOINED_CHANNEL} from './store/mutations';
    import {mapState, mapActions} from 'vuex';

    export default {
        components: {
            ChatApp
        },
        computed: mapState(['messages', 'channels', 'currentChannel']),
        methods: {
            ...mapActions({
                newMessage: SEND_NEW_MESSAGE,
                newChannel: CREATE_NEW_CHANNEL,
            }),
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
                            this.$store.commit({
                                type: NEW_MESSAGE,
                                message: e,
                            });
                        });

                    this.$store.commit({
                        type: JOINED_CHANNEL,
                        channel
                    });
                } catch (e) {
                    console.log(e);
                }
            }
        },
        mounted () {
            this.$store.dispatch(LIST_CHANNELS);

            Echo.private(`companies.${window.Laravel.company.id}`)
                .listen('ChannelCreated', (e) => {
                    this.$store.commit({
                        type: NEW_CHANNEL,
                        channel: e.channel
                    });
                });
        }
    }
</script>


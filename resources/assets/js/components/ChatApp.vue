<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <div class="list-group-item-heading" >
                        Channels
                    </div>

                    <a
                        href
                        class="list-group-item"
                        v-for="channel in channels"
                        :key="channel.id"
                        v-text="`#${channel.name}`"
                        :class="{'active': currentChannel && currentChannel.id === channel.id}"
                        @click.prevent="joinChannel(channel)"
                    >
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default channel-chat" v-if="currentChannel">
                    <div class="panel-heading">This is your chat app</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>

                <div class="panel panel-default channel-chat not-joined" v-else>
                    <div class="panel-body text-center">
                        Please join a channel from the list to start chatting.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                channels: [
                    {id: 1, name: 'general'},
                    {id: 2, name: 'backend'},
                ],
                currentChannel: null,
            };
        },
        methods: {
            joinChannel (channel) {
                if (this.currentChannel && this.currentChannel.id === channel.id) {
                    return;
                }

                if (this.currentChannel) {
                    Echo.leave(`channels.${this.currentChannel.id}`);
                }

                Echo.private(`channels.${channel.id}`)
                    .listen('Channels.NewMessage', (e) => {
                        console.log(e);
                    });

                this.currentChannel = channel;
            }
        }
    }
</script>


<style scoped>
    .list-group-item-heading {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .channel-chat {
        height: 70vh;
    }

    .not-joined {
        padding-top: 35%;
    }
</style>

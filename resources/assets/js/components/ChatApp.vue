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

                <div class="new-channel-form">
                    <button class="btn btn-default btn-block" v-if="!showForm" @click.prevent="showForm = true">
                        Create Channel
                    </button>

                    <form @submit.prevent="addChannel()" v-if="showForm">
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="newChannel" @keydown.enter.prevent="addChannel()" />
                        </div>

                        <button @click.prevent="showForm = false" class="btn btn-default btn-sm">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-default btn-sm">
                            Create
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default channel-chat" v-if="currentChannel">
                    <div class="panel-heading">#{{ currentChannel.name}}</div>

                    <div class="panel-body chat-content">
                        <div class="chat-messages" ref="chat">
                            <div class="media" v-for="message in messages" :key="message.uuid">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" :src="message.user.avatar_path" alt="User profile" />
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading">{{ message.user.name }} <small class="text-muted">{{ message.sentAt }}</small></h5>

                                    <p v-text="message.content"></p>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <textarea
                                    type="text"
                                    class="form-control"
                                    v-model="newMessage"
                                    rows="2"
                                    :placeholder="`Message #${currentChannel.name}`"
                                    @keydown.enter.prevent="sendMessage()"
                            >
                            </textarea>
                        </div>
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
        props: [
            'channels',
            'messages',
            'currentChannel',
        ],
        data () {
            return {
                newMessage: '',
                newChannel: '',
                showForm: false,
            };
        },
        methods: {
            joinChannel (channel) {
                this.$emit('join-channel', channel);
            },
            sendMessage () {
                if (!this.newMessage) {
                    return;
                }

                this.$emit('new-message', this.newMessage);
                this.newMessage = '';
            },
            addChannel () {
                if (!this.newChannel) {
                    return;
                }

                this.$emit('new-channel', this.newChannel);
                this.newChannel = '';
                this.showForm = false;
            }
        },
        watch: {
            messages () {
                setTimeout(() => {
                    this.$refs.chat.scrollTo(0, this.$refs.chat.scrollHeight);
                }, 100);
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

    .chat-content {
        height: 100%;
    }

    .chat-messages {
        overflow-y: scroll;
        height: 78%;
    }

    @media screen and (max-width: 480px){
        .channel-chat {
            height: 65vh;
        }

        .chat-messages {
            height: 65%;
        }
    }
</style>

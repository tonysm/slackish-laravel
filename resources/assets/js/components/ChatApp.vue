<template>
    <div class="font-sans antialiased h-screen flex">
        <!-- Sidebar / channel list -->
        <div class="bg-indigo-darker text-purple-lighter flex-col w-64 pb-6 hidden md:block relative">
            <div class="text-white mb-2 mt-3 px-4 flex justify-between">
                <div class="flex-auto">
                    <h1 class="font-semibold text-xl leading-tight mb-1 truncate">{{ currentCompany.name }}</h1>
                    <div class="flex items-center mb-6">
                        <span class="bg-green rounded-full block w-2 h-2 mr-2"></span>
                        <span class="text-white opacity-50 text-sm">{{ currentUser.name }}</span>
                    </div>
                </div>
                <div>
                    <svg class="h-6 w-6 fill-current text-white opacity-25" viewBox="0 0 20 20">
                        <path d="M14 8a4 4 0 1 0-8 0v7h8V8zM8.027 2.332A6.003 6.003 0 0 0 4 8v6l-3 2v1h18v-1l-3-2V8a6.003 6.003 0 0 0-4.027-5.668 2 2 0 1 0-3.945 0zM12 18a2 2 0 1 1-4 0h4z" fill-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="mb-8">
                <div class="px-4 mb-2 text-white flex justify-between items-center">
                    <div class="opacity-75">Channels</div>
                    <div>
                        <a href class="text-white" @click.prevent="showForm = true">
                            <svg class="fill-current h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <a href class="text-white no-underline" @click.prevent="joinChannel(channel)" v-for="channel in channels">
                    <div class="py-1 px-4 hover:bg-teal-dark hover:text-white" :class="{ 'bg-teal-dark': currentChannel && currentChannel.id === channel.id, 'opacity-50': !currentChannel || currentChannel.id !== channel.id  }">
                        # {{channel.name}}
                    </div>
                </a>

                <form class="w-full max-w-md m-4 flex" v-show="showForm" @submit.prevent="addChannel">
                    <input
                        class="appearance-none w-2/3 p-2 rounded bg-grey-lightest focus:bg-white"
                        v-model="newChannel"
                        type="text"
                        placeholder="New Channel"
                        @keypress.esc.prevent="showForm = false"
                        autofocus
                    />
                    <button class="text-white ml-2 py-2 px-3 text-xs border boder-grey-lightest rounded">Save</button>
                </form>
            </div>
            <div class="p-4 flex absolute pin-b flex-col-reverse w-full text-center">
                <div class="m-4">
                    <div class="opacity-75">
                        <a href @click.prevent="$emit('logout')" class="py-2 px-6 rounded border border-white-light text-white no-underline">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Chat content -->
        <div class="flex-1 flex flex-col bg-white overflow-hidden" v-if="currentChannel">
            <!-- Top bar -->
            <div class="border-b flex px-6 py-2 items-center flex-none">
                <div class="flex flex-col">
                    <h3 class="text-grey-darkest mb-1 font-extrabold">#{{currentChannel.name}}</h3>
                    <div class="text-grey-dark text-sm truncate">
                        Chit-chattin' about ugly HTML and mixing of concerns.
                    </div>
                </div>
                <div class="ml-auto hidden md:block">
                    <div class="relative">
                        <input type="search" placeholder="Search" class="appearance-none border border-grey rounded-lg pl-8 pr-4 py-2">
                        <div class="absolute pin-y pin-l pl-3 flex items-center justify-center">
                            <svg class="fill-current text-grey h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Chat messages -->
            <div class="px-6 py-4 flex-1 overflow-y-scroll" ref="chat">
                <!-- A message -->
                <div class="flex items-start mb-4 text-sm" v-for="message in messages" :key="message.uuid">
                    <img :src="message.user.avatar_path" class="w-10 h-10 rounded mr-3">
                    <div class="flex-1 overflow-hidden">
                        <div>
                            <span class="font-bold">{{ message.user.name }}</span>
                            <span class="text-grey text-xs">{{ message.sentAt }}</span>
                        </div>
                        <p class="text-black leading-normal">{{ message.content }}</p>
                    </div>
                </div>

            </div>
            <div class="pb-6 px-4 flex-none">
                <div class="flex rounded-lg border-2 border-grey overflow-hidden">
                <span class="text-3xl text-grey border-r-2 border-grey p-2">
                    <svg class="fill-current h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z"/></svg>
                  </span>
                    <input type="text" autofocus class="w-full px-4" v-model="newMessage" @keypress.enter.prevent="sendMessage" :placeholder="`Message #${currentChannel.name}`" />
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
            'currentUser',
            'currentCompany',
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
            },
        },
        watch: {
            messages () {
                setTimeout(() => {
                    this.$refs.chat.scrollTo(0, this.$refs.chat.scrollHeight);
                }, 100);
            }
        },
    }
</script>
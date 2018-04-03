export const SET_CHANNELS = 'channels/set_channels';
export const NEW_CHANNEL = 'channels/new_channel';
export const JOINED_CHANNEL = 'channels/joined_channel';
export const NEW_MESSAGE = 'channels/new_message';
export const LOAD_USER = 'users/LOAD';
export const LOAD_USERS = 'users/LOAD_ALL';
export const USER_JOINED = 'users/JOINED';
export const USER_LEFT = 'users/LEFT';

export default {
    [SET_CHANNELS] (state, {channels}) {
        state.channels = channels;
    },
    [NEW_CHANNEL] (state, {channel}) {
        state.channels.push(channel);
    },
    [JOINED_CHANNEL] (state, {channel}) {
        state.currentChannel = channel;
        state.messages = [];
    },
    [NEW_MESSAGE] (state, {message}) {
        state.messages.push(message);
    },
    [LOAD_USER] (state, {user, company}) {
        state.user = user;
        state.company = company;
    },
    [LOAD_USERS] (state, {users}) {
        state.users = users;
    },
    [USER_JOINED] (state, {user}) {
        state.users.push(user);
    },
    [USER_LEFT] (state, {user}) {
        let index = state.users.findIndex(u => u.id === user.id);
        state.users.splice(index, 1);
    }
}
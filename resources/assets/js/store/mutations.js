export const SET_CHANNELS = 'channels/set_channels';
export const NEW_CHANNEL = 'channels/new_channel';
export const JOINED_CHANNEL = 'channels/joined_channel';
export const NEW_MESSAGE = 'channels/new_message';

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
  }
}
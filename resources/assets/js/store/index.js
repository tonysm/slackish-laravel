import actions from './actions';
import mutations from './mutations';

const state = {
  messages: [],
  channels: [],
  currentChannel: null
};

export default {
  state,
  actions,
  mutations,
};
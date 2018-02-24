import actions from './actions';
import mutations from './mutations';

const state = {
    messages: [],
    channels: [],
    currentChannel: null,
    user: null,
    company: null,
};

export default {
    state,
    actions,
    mutations,
};
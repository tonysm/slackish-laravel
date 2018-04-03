import actions from './actions';
import mutations from './mutations';

const state = {
    messages: [],
    channels: [],
    currentChannel: null,
    user: null,
    company: null,
    users: [],
};

export default {
    state,
    actions,
    mutations,
};
import Uuid from 'uuid';

class Channel {
    constructor(id, name) {
        this.id = id;
        this.name = name;
    }
}

export function getChannels() {
    return axios('/api/channels')
        .then(({data}) => (
            data.data.map((channel) => new Channel(channel.id, channel.name))
        ));
}

export function sendMessage(channel, message) {
    return axios.post(`/api/channels/${channel.id}/messages`, {
        content: message,
        uuid: Uuid.v4(),
    });
}
const sources = [
    {
        id: 'mds_voice',
        priority: 10,
        name: 'МДС Голос',
        fullName: 'Модель для сборки - голос.',
        url: 'http://ice.planeset.ru:8000/mds_voice.mp3'
    },
    {
        id: 'mds_music',
        priority: 20,
        name: 'МДС Музыка',
        fullName: 'Модель для сборки - музыка.',
        url: 'http://ice.planeset.ru:8000/mds.mp3'
    }
];

const state = {
    sources: [],
    currentSourceId: ''
};
const mutations = {
    setSourceId(state, {id}) {
        state.currentSourceId = id;
    },
    addSource({sources}, source) {
        sources.push(source)
    }
};
const getters = {
    getSourceById: state => id =>  {
        for (let source of state.sources) {
            if (source.id === id) {
                return source;
            }
        }

        return {};
    },
    getCurrentSource: (state, getters) => {
        return getters.getSourceById(state.currentSourceId);
    },
};

const actions = {
    getSources: async({commit}) => {
        //** TODO: websocket in this place ?
        let promise = new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve(JSON.stringify(sources));
            }, 1500)
        });
        const data = await promise;
        JSON.parse(data).forEach((source) => {
            commit('addSource', source);
        });
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
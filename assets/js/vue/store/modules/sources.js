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
    sources
};
const getters = {
    getSourceById: state => id =>  {
        for (let source of state.sources) {
            if (source.id === id) {
                return source;
            }
        }

    }
};

export default {
    namespaced: true,
    state,
    getters
}
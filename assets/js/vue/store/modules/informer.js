const informer = [
    {
        sourceId: 'mds_voice',
        songName: 'Тестовая песнь',
        amount: 5
    },
];
const state = {
    informer: []
};

const mutations = {
    addInformer(state, informer) {
        state.informer.push(informer);
    }
};

const getters = {
    getInformer: (state) => sourceId => {
        let informer = state.informer.find(function (informer) {
            return informer.sourceId === sourceId;
        });

        if (!informer) {
            informer = {
                sourceId: sourceId,
                songName: 'Имя трека еще не загружено или недоступно.',
                amount: 0
            }
        }

        return informer;

    },
    getPeopleAmount: state => sourceId => {
        let amount = 0;
        if (!sourceId) {
            state.informer.forEach(informer => {
                amount += Number(informer.amount);
            });
        } else {
            state.informer.forEach(informer => {
                if (informer.sourceId === sourceId) {
                    amount += Number(informer.amount);
                }
            })
        }

        return amount;

    }
};
const actions = {
    getInformers: async ({commit}) =>  {

        //** TODO: websocket in this place ?
        let promise = new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve(JSON.stringify(informer));
            }, 1500)
        });

        const data = await promise;
        JSON.parse(data).forEach((informer) => {
            commit('addInformer', informer);
        });
    }
};
export default {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
};
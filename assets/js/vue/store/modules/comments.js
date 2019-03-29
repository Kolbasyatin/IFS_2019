const state = {
    comments: [
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_music'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },
        // {
        //     name: 'Zalex',
        //     message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
        //     date: '01.01.3001',
        //     sourceId: 'mds_voice'
        // },

    ],
    news: [
        {
            name: 'Breaking News!',
            message: `Счастье есть.`,
            date: '29.03.3019',
            sourceId: ''
        }
    ]
};


const getters = {
    getCurrentComments: (state, getters, rootState, rootGetters) => {
        const currentSource = rootGetters['sources/getCurrentSource'];
        let sourceId;
        let result;
        if (!Object.keys(currentSource).length) {
            result = state.news;
        } else {
            sourceId = currentSource.id;
            result = state.comments.filter(comment => {
                return comment.sourceId === sourceId;
            })
        }

        return result;
    }
};

const mutations = {
    addComment: (state, comment) => {
        state.comments.push(comment);
    },
    addNews: (state, payload) => {
        state.news.push(payload);
    }
};

const actions = {
    showMoreComments: async (context) => {

        //dev
        return;

        let promise = new Promise(function(resolve, reject)  {
            setTimeout(() => {
                resolve("alloha!");
            }, 1500)
        });



        const res = await promise;
        console.log(res);

        let comment =
            {
                name: 'NewComment',
                message: `New com ment message`,
                date: '01.02.2002',
                sourceId: 'mds_voice'
            };

        context.commit('addComment', comment);
    }

};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
import {shuffle} from 'lodash';

const state = {
    comments: [
        {
            name: 'Zalex1',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 0,
        },
        {
            name: 'Zalex2',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 1,

        },
        {
            name: 'Zalex3',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 2,
        },
        {
            name: 'Zalex4',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 3,
        },
        {
            name: 'Zalex5',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 4,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 5,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_music',
            id: 6,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 7,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 8,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 9,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 10,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 11,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 12,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 13,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 14,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 15,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 16,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 17,
        },
        {
            name: 'Zalex',
            message: `Тут мог бы быть ваш комментарий. Но скорее всего его не будет.`,
            date: '01.01.3001',
            sourceId: 'mds_voice',
            id: 18,
        },

    ],
    news: [
        {
            name: 'Breaking News!',
            message: `Счастье есть.`,
            date: '29.03.3019',
            sourceId: '',
            id: 19
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
    },
    addCommentToStart: (state) => {
        // state.comments.unshift(
        //     {
        //         name: 'Zalex',
        //         message: `Я вставленный коммент.`,
        //         date: '01.01.3001',
        //         sourceId: 'mds_voice',
        //         id: 100
        //     }
        // );
        // /*state.comments = */state.comments.splice(1, 1);
        // state.comments = shuffle(state.comments);
    }
};

const actions = {
    showMoreComments: async (context) => {

        //dev
        return;

        let promise = new Promise(function (resolve, reject) {
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
                sourceId: 'mds_voice',
                id: 100
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
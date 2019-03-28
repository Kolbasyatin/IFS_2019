import moment from "moment";

const state = {
    now: new Date()
};

const getters = {
    getRealDateTime: state => {
        return state.now;
    },
    getShipDateTime: state => {
        return moment(state.now).add(1000, 'years');
    }
};

const mutations = {
    updateTime: state => {
        state.now = new Date();
    }
};

const actions = {
    startTime({commit}) {
        setInterval(() => {
            commit('updateTime')
        }, 1000);
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
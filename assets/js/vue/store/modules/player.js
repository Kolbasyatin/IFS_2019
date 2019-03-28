
const state = {
    playerState: {
        isPlayingNow: false,
        isPausedNow: true,
        isStartingProcess: false,
        currentSourceId: {id: ''}
    }
};
const mutations = {
    setIsStarting({playerState}) {
        playerState.isStartingProcess = true;
    },
    setIsPlayingNow({playerState}) {
        playerState.isStartingProcess = false;
        playerState.isPlayingNow = true;
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    // getters,
    // actions
}



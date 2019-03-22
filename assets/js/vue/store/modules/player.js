//** TODO: Вынести аудио в компонент, навешать на эвенты комиты мутаций и через watch отслеживать изменения ?
const audio = new Audio();
audio.preload = 'none';
audio.onplaying = () => {
    console.log(this);
};

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

    // play({player}, {id}) {
    //     if (player.src === url) {
    //         console.log('уже запущено');
    //         return;
    //     }
    //     if (!player.paused) {
    //         this.commit('pause');
    //     }
    //     player.src = url;
    //     player.play();
    // },
    // pause(state) {
    //     state.player.pause()
    // }
};

const getters = {
    getPlayerStatus({player}) {
        return audio.paused;
    }
};

const actions = {
    async startPlay({rootGetters, commit}, {id}) {
        const source = rootGetters['sources/getSourceById'](id);
        // commit('setIsStarting');
        audio.src = source.url;
        await audio.play();
        // commit('setIsPlayingNow');
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
}



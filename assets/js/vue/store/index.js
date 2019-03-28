import Vuex from 'vuex';
import Vue from 'vue';
import createLogger from 'vuex/dist/logger'
import player from './modules/player'
import sources from "./modules/sources";
import {library} from "@fortawesome/fontawesome-svg-core";
import {faPlay, faPause, faVolumeOff, faVolumeMute, faVolumeDown, faVolumeUp} from "@fortawesome/free-solid-svg-icons";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import travel from "./modules/travel";

library.add(faPlay, faPause, faVolumeOff, faVolumeMute, faVolumeDown, faVolumeUp);
Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';
let plugins = [];
if(debug) {
    plugins.push(createLogger())
}

const store = new Vuex.Store({
    strict: debug,
    plugins,
    modules: {
        player,
        sources,
        travel
    }
});

export default store;
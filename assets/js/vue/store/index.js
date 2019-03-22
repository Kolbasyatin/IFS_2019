import Vuex from 'vuex';
import Vue from 'vue';
import createLogger from 'vuex/dist/logger'
import player from './modules/player'
import sources from "./modules/sources";

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
        sources
    }
});

export default store;
require('../css/app.scss');
var debounce = require('lodash.debounce');
import Main from './components/Main';

window.Event = new Vue();

Vue.component('app', Main);

const app = new Vue({
    el: '#app'
});

function throwBlackDiceEvent(e) {
    if(e.keyCode == 32) {
        Event.$emit('event:spacebar');
    }
}

document.body.addEventListener("keyup", debounce((e) => throwBlackDiceEvent(e), 3000, {leading: true, trailing: false}));

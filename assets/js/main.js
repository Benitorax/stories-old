require('../css/app.scss');
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

document.body.addEventListener("keyup", _.debounce((e) => throwBlackDiceEvent(e), 1500, {leading: true, trailing: false}));

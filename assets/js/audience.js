require('../css/app.css');
import Audience from './components/Audience';

window.Event = new Vue();

Vue.component('Audience', Audience);

const app = new Vue({
    el: '#app'
});

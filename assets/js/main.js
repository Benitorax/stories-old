require('../css/app.css');
import Main from './components/Main';

window.Event = new Vue();

Vue.component('app', Main);

const app = new Vue({
    el: '#app'
});

import { Controller } from 'stimulus';
import Vue from 'vue';
import Main from '../js/components/Main';


export default class extends Controller {
    connect() {
        window.Event = new Vue();

        Vue.component('app', Main);
        
        const app = new Vue({
            el: this.element.id
        });
        
        function throwBlackDiceEvent(e) {
            if(e.keyCode == 32) {
                Event.$emit('event:spacebar');
            }
        }
        
        document.body.addEventListener("keyup", _.debounce((e) => throwBlackDiceEvent(e), 1500, {leading: true, trailing: false}));
    }
}

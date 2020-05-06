<template>
    <transition-group name="list-commands" v-if="isShowed" class="buttons columns">
        <div key="1" class="column is-full">
            <button :disabled="isAllowed == false" class="button is-primary is-large is-fullwidth" @click="onThrowDice">Lancer<i style="font-size: 25px;margin-left: 10px" class="fas fa-cube"></i></button>
        </div>
        <div v-if="count > 0" key="2" class="column is-full has-margin-top-4">
            <button class="button is-danger is-large is-fullwidth" @click="onNewGame">{{ buttonText }}</button>
        </div>
    </transition-group>
</template>

<script>
    import DiceConverter from './../DiceConverter';
    import Ajax from './../Ajax';

    export default {
        props: ['step', 'users', 'user'],
        data() {
            return {
                isShowed: true,
                isAllowed: true,
                count: 0,
                firstDigit: 0,
            }
        },
        computed: {
            buttonText() {
                let users = this.users.filter(user => user.points == '');
                if(users.length == 0) return 'Voir classement';
                else return 'Joueur suivant';
            }
        },
        methods: {
            onThrowDice() {
                this.hideTemporary();
                Ajax.get('dice/number').then(({data}) => {
                    let digit = data.number;
                    let ordinalNumber = '';
                    if(this.count === 0) {
                        ordinalNumber = 'premier';
                        this.firstDigit = digit;
                    } else ordinalNumber = 'second';
                    
                    Event.$emit('rating:dice', { 
                        message: 'Résultat du ' + ordinalNumber + ' dé : ' + digit,
                        colorClass: 'yellow', 
                        iconClass: 'dice-'+ DiceConverter.convertNumberToLetter(digit)
                    });
                    Event.$emit('user:update', { points: this.firstDigit + digit, try: 2 });
                    if(this.count === 0) {
                        Event.$emit('message:add', { iconClass: 'paint-brush', message: this.user.username + ' méritait mieux ? Les autres joueurs peuvent accorder un 2e lancer.' });
                        Event.$emit('message:add', { iconClass: 'paint-brush', message: 'ESPACE pour attribuer un 2e lancer.' });                    
                    }
                    this.count += 1;
                    this.isAllowed = false;
                });
            },
            onNewGame() {
                this.hideTemporary();
                Event.$emit('parameters:update', { step: 'start', mode: '', subject: '' });  
            },
            hideTemporary() {
                this.isShowed = false;
                setTimeout(() => this.isShowed = true, 500);
            },
            allowSecondDice() {
                if(this.step !== 'rating') return;
                if(this.count < 2) this.isAllowed = true;
            }
        },
        mounted() {
            Event.$on('event:spacebar', () => this.allowSecondDice());
        },
    }
</script>

<style>
    .list-commands-enter-active {
        transition: opacity 1.5s;
    }   
    .list-commands-enter, .commands-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
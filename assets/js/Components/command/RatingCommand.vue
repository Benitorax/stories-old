<template>
    <transition-group name="list-commands" v-if="isShowed" class="buttons columns">
        <div v-if="isAllowedToRollDice" key="1" class="column is-full">
            <button class="button is-primary is-large is-fullwidth" @click="onThrowDice">Lancer<i style="font-size: 25px;margin-left: 10px" class="fas fa-cube"></i></button>
        </div>
        <div v-if="rolledDiceCount > 0" key="2" class="column is-full">
            <button v-if="isNoUsersRemaining" class="button is-danger is-large is-fullwidth" @click="onResultStep">Voir classement</button>
            <button v-else class="button is-danger is-large is-fullwidth" @click="onStartStep">Joueur suivant</button>
        </div>
        <div v-if="showAllowSecondDiceButton" key="3" class="column is-full is-hidden-tablet">
            <button class="button is-info is-large is-fullwidth" @click="allowSecondDice">Attribuer 2e lancer</button>
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
                isAllowedToRollDice: true,
                rolledDiceCount: 0,
                firstDigit: 0,
                showAllowSecondDiceButton: false
            }
        },
        computed: {
            isNoUsersRemaining() {
                let users = this.users.filter(user => user.points == '');
                if(users.length == 0) return true;
                else return false;
            }
        },
        methods: {
            onThrowDice() {
                this.isShowed = false;
                Ajax.get('dice/number').then(({data}) => {
                    let digit = data.number;
                    let ordinalNumber = '';
                    if(this.rolledDiceCount === 0) {
                        ordinalNumber = 'premier';
                        this.firstDigit = digit;
                    } else {
                        ordinalNumber = 'second';
                        this.showAllowSecondDiceButton = false;
                    }

                    Event.$emit('message:add', { message: 'Résultat du ' + ordinalNumber + ' dé : ' + digit, colorClass: 'yellow', iconClass: 'dice-'+ DiceConverter.convertNumberToLetter(digit) });
                    if(this.rolledDiceCount === 0) {
                        Event.$emit('user:update', { points: digit, try: 1 });
                        Event.$emit('message:add', { iconClass: 'paint-brush', message: this.user.username + ' méritait mieux ? Les autres joueurs peuvent accorder un 2e lancer.' });
                        Event.$emit('message:add', { iconClass: 'paint-brush', message: 'ESPACE pour attribuer un 2e lancer.' }); 
                        this.showAllowSecondDiceButton = true;                   
                    } else {
                        Event.$emit('message:add', { message: 'Note finale : ' + (this.firstDigit + digit), colorClass: 'yellow', iconClass: 'paint-brush' });
                        Event.$emit('user:update', { points: this.firstDigit + digit, try: 2 });
                    }
                    this.rolledDiceCount += 1;
                    this.isAllowedToRollDice = false;
                    this.isShowed = true;
                });
            },
            onResultStep() {
                this.isShowed = false;
                Event.$emit('parameters:update', { step: 'result', mode: '', subject: '' });  
            },
            onStartStep() {
                this.isShowed = false;
                Event.$emit('parameters:update', { step: 'start', mode: '', subject: '' });  
            },
            allowSecondDice() {
                if(this.step !== 'rate') return;
                if(this.rolledDiceCount < 2) this.isAllowedToRollDice = true;
            }
        },
        mounted() {
            Event.$emit('message:reset');
            Event.$emit('message:add', { message: 'Lancez le dé pour vous noter.', iconClass: 'paint-brush', colorClass: null });
            Event.$on('event:spacebar', () => this.allowSecondDice());
        },
        beforeDestroy() {
            Event.$off('event:spacebar');
        }
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
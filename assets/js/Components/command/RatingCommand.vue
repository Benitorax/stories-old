<template>
    <transition-group name="list-commands" v-if="isShowed" class="buttons columns">
        <div v-if="isAllowed" key="1" class="column is-full">
            <button class="button is-primary is-large is-fullwidth" @click="onThrowDice">Lancer<i style="font-size: 25px;margin-left: 10px" class="fas fa-cube"></i></button>
        </div>
        <div v-if="count > 0" key="2" class="column is-full">
            <button class="button is-danger is-large is-fullwidth" @click="onNewGame">Nouvelle partie</button>
        </div>
    </transition-group>
</template>

<script>
    import DiceConverter from './../DiceConverter';
    import Ajax from './../Ajax';

    export default {
        props: ['step'],
        data() {
            return {
                isShowed: true,
                isAllowed: true,
                count: 0
            }
        },
        methods: {
            onThrowDice() {
                this.hideTemporary();
                Ajax.get('dice/number').then(({data}) => {
                    let digit = data.number
                    let ordinalNumber = '';
                    if(this.count === 0) {
                        ordinalNumber = 'premier';
                    } else {
                        ordinalNumber = 'second';
                    }
                    Event.$emit('rating:dice', { 
                        message: 'Résultat du ' + ordinalNumber + ' dé : ' + digit,
                        colorClass: 'yellow', 
                        iconClass: 'dice-'+ DiceConverter.convertNumberToLetter(digit)
                    });
                    this.count += 1;
                    this.isAllowed = false;
                });
            },
            onNewGame() {
                this.hideTemporary();
                Event.$emit('parameters:update', { step: 'start' });  
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
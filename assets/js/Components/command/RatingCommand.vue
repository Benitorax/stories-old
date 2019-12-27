<template>
    <div v-if="isShowed" class="buttons columns">
        <div v-if="isAllowed" class="column is-full">
            <button class="button is-primary is-large is-fullwidth" @click="onThrowDice">Lancer<i style="font-size: 25px;margin-left: 10px" class="fas fa-cube"></i></button>
        </div>
        <div v-if="count > 0" class="column is-full">
            <button class="button is-danger is-large is-fullwidth" @click="onNewGame">Nouvelle partie</button>
        </div>
    </div>
</template>

<script>
    import DiceConverter from './../DiceConverter';

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
                let digit = Math.floor(Math.random() * 6) + 1;
                    let number = '';
                    if(this.count === 0) {
                        number = 'premier';
                    } else {
                        number = 'second';
                    }
                Event.$emit('rating:dice', { 
                    message: 'Résultat ' + number + ' dé : ' + digit,
                    colorClass: 'yellow', 
                    iconClass: 'dice-'+ DiceConverter.convertNumberToLetter(digit)
                });
                this.count += 1;
                this.isAllowed = false;
            },
            onNewGame() {
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

</style>
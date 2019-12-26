<template>
    <div>
        <div style="margin-bottom: 25px">
            <span class="is-size-4">Dés restants : {{ diceLeft }}</span>
        </div>
        <div v-if="isShowed" class="buttons columns">
            <div v-if="isThrowDiceShowed" class="column is-full">
                <button class="button is-primary is-large is-fullwidth" @click="throwDice">Lancer<i style="font-size: 25px;margin-left: 10px" class="fas fa-cube"></i></button>
            </div>
            <div v-if="diceLeft === 0" class="column is-full">
                <button class="button is-link is-large is-fullwidth" @click="onRating">Notez vous-même !</button>
            </div>
            <div v-if="showWhiteDice" class="column is-full">
                <button class="button is-link is-large is-fullwidth" @click="throwWhiteDice">Lancé dé blanc</button>
            </div>
        </div>
    </div>
</template>

<script>
    import Ajax from './../Ajax';

    export default {
        props: ['mode'],
        data() {
            return {
                diceCount: 0,
                blackDiceCount: 0,
                whiteDiceCount: 0,
                isShowed: true,
            }
        },
        computed: {
            showWhiteDice() {
                return this.mode === 'whiteDice' && 
                    this.whiteDiceCount === 0 && 
                    this.diceCount < 5 &&
                    this.diceCount > 0;
            },
            isThrowDiceShowed() {
                return ((this.mode === 'normal') && (this.diceCount < 6)) ||
                    (this.mode === 'whiteDice' && (
                            (this.whiteDiceCount === 1 && this.diceCount < 5) ||
                            (this.whiteDiceCount === 0  && this.diceCount < 4)
                    ));
            },
            diceLeft() {
                return 6 - (this.diceCount + this.whiteDiceCount);
            }
        },
        methods: {
            throwDice() {
                this.hideTemporary();
                let color = this.defineColor();
                this.diceCount += 1;
                Ajax.get('dice/'+ color).then(({data}) => {
                    Event.$emit('game:message', { 
                        message: data.message, 
                        iconClass: 'cube',
                        colorClass: color
                    });
                }).catch((error) => console.log('error from throwing dice', error));
            },
            throwWhiteDice() {
                this.hideTemporary();
                this.whiteDiceCount += 1;
                Ajax.get('dice/white').then(({data}) => {
                    Event.$emit('game:message', { 
                        message: data.message, 
                        iconClass: 'cube',
                        colorClass: 'white'
                    });
                }).catch((error) => console.log('error from throwing dice', error));
            },
            defineColor() {
                let c = this.diceCount;
                if(c === 0) return 'yellow'
                else if(c === 1) return 'orange'
                else if(c === 2) return 'red'
                else if(c === 3) return 'violet'
                else if(this.mode === 'normal') {
                    if(c === 4) return 'blue'
                    else if(c === 5) {
                        return 'dark-blue'
                    }
                } else if(this.mode === 'whiteDice') {
                    return 'dark-blue';
                }
            },
            hideTemporary() {
                this.isShowed = false;
                setTimeout(() => this.isShowed = true, 500);
            },
            hideDefinitively() {
                this.isShowed = false;
            },
            onRating() {
                this.hideDefinitively();
                Event.$emit('parameters:update', { step: 'rating' });
            }
        },
    };
</script>

<style>
</style>
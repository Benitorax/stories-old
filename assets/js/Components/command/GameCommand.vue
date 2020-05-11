<template>
    <div>
        <div style="height: 300px">
            <div style="margin-bottom: 25px">
                <span v-for="diceClass in diceIcons" :key="diceClass" class="has-margin-right-7" :class="diceClass"><i class="fas fa-cube fa-3x"></i></span>    
            </div>
            <transition name="commands">
                <div v-if="isShowed" class="buttons columns">
                    <div v-if="isThrowDiceShowed" class="column is-full">
                        <button class="button is-primary is-large is-fullwidth" @click="throwDice">Lancer<i style="font-size: 25px;margin-left: 10px" class="fas fa-cube"></i></button>
                    </div>
                    <div v-if="diceLeft === 0" class="column is-full">
                        <button class="button is-link is-large is-fullwidth" @click="onRating">Notez vous-même !</button>
                    </div>
                    <div v-if="showWhiteDice" class="column is-full">
                        <button class="button is-outlined is-large is-fullwidth" @click="throwWhiteDice">Lancer dé blanc<i style="font-size: 25px;margin-left: 10px" class="fas fa-cube"></i></button>
                    </div>
                </div>
                <div>
                </div>
            </transition>
        </div>
        <div>
            <div style="margin-bottom: 25px">
                <span v-for="index in (3-blackDiceCount)" :key="index" class="has-margin-right-7"><i class="fas fa-cube fa-3x"></i></span>    
            </div>
            <div v-if="isShowed" class="columns">
                <div v-if="blackDiceCount < 3 && diceLeft > 0 && diceCount > 0" class="column is-full button-audience">
                    <button class="button is-black is-large is-fullwidth">ESPACE pour lancer<i style="font-size: 25px;margin-left: 10px" class="fas fa-cube"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Ajax from './../Ajax';

    export default {
        props: ['parameters'],
        data() {
            return {
                diceCount: 0, // whiteDice isn't counted
                blackDiceCount: 0,
                whiteDiceCount: 0,
                isShowed: true
            }
        },
        computed: {
            step() {
                return this.parameters.step;
            },
            mode() {
                return this.parameters.mode;
            },
            subject() {
                return this.parameters.subject;
            },
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
            },
            diceIcons(diceLeft) {
                let icons = ['icon-yellow', 'icon-orange', 'icon-red', 'icon-violet', 'icon-blue', 'icon-dark-blue'];
                if(this.mode === 'normal') return icons.slice(this.diceCount);
                else {
                    if(this.whiteDiceCount === 0) icons[5] = 'icon-white';
                    else icons.slice(0, -1);
                    return icons.slice(this.diceCount + this.whiteDiceCount);
                }  
            }
        },
        methods: {
            throwDice() {
                this.isShowed = false;
                let color = this.defineColor();
                this.diceCount += 1;
                Ajax.get('dice/'+ color).then(({data}) => {
                    Event.$emit('message:add', { 
                        message: data.message, 
                        iconClass: 'cube',
                        colorClass: color
                    });
                    this.isShowed = true;
                });
            },
            throwWhiteDice() {
                this.isShowed = false;
                this.whiteDiceCount += 1;
                Ajax.get('dice/white').then(({data}) => {
                    Event.$emit('message:add', { 
                        message: data.message, 
                        iconClass: 'cube',
                        colorClass: 'white'
                    });
                    this.isShowed = true;
                });
            },
            throwBlackDice() {
                this.blackDiceCount += 1;
                this.isShowed = false;
                Ajax.get('dice/black').then(({data}) => {
                    Event.$emit('message:add', { 
                        message: data.message, 
                        iconClass: 'cube',
                        colorClass: 'black'
                    });
                    this.isShowed = true;
                });
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
            onRating() {
                this.isShowed = false;
                Event.$emit('parameters:update', { step: 'rate' });
            },
            throwBlackDiceEvent() {
                if(this.step === 'play' && this.blackDiceCount < 3) {
                    if(this.diceCount === 0) return;
                    if(this.mode === 'normal' && this.diceCount <= 5) this.throwBlackDice();
                    else if(this.mode === 'whiteDice' && (this.diceCount + this.whiteDiceCount) <= 5) this.throwBlackDice();
                }
            }
        },
        mounted() {
            Event.$emit('message:reset');
            Event.$emit('message:add', { message: this.subject, iconClass: 'comment-dots', colorClass: null });
            Event.$on('event:spacebar', () => this.throwBlackDiceEvent());
        },

    };
</script>

<style scoped>
    .dices-enter-active, .dices-leave-active {
        transition: all 1.5s;
    }   
    .dices-enter, .commands-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    .commands-enter-active {
        transition: opacity 1.5s;
    }   
    .commands-enter, .commands-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    .icon-yellow {
        color: rgb(226, 226, 98);
    }
    .icon-orange {
        color: rgb(235, 127, 84);
    }
    .icon-red {
        color: rgb(235, 81, 81);
    }
    .icon-violet {
        color: rgb(226, 96, 226);
    }
    .icon-blue {
        color: rgb(100, 181, 231);
    }
    .icon-dark-blue {
        color: blue;
    }
    .icon-white {
        color: gainsboro;
    }
</style>
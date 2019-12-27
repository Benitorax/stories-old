<template>
    <div>
        <transition name="commands">
            <OptionsCommand v-if="isOptionsStep"></OptionsCommand>
            <GameCommand v-else-if="step === 'playing'" :mode="mode" :step="step"></GameCommand>
            <RatingCommand v-else-if="step === 'rating'" :step="step"></RatingCommand>
        </transition>
    </div>
</template>

<script>
    import GameCommand from './GameCommand';
    import OptionsCommand from './OptionsCommand';
    import SelectModeCommand from './SelectModeCommand';
    import RatingCommand from './RatingCommand';

    export default {
        components: { 
            GameCommand,
            OptionsCommand,
            SelectModeCommand,
            RatingCommand
        },
        props: ['parameters'],
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
            isOptionsStep() {
                return ['start', 'startDice', 'selectSubject', 'freeSubject'].includes(this.parameters.step);
            },
        }
    };
</script>

<style>
    .commands-enter-active {
        transition: opacity 1.5s;
    }   
    .commands-enter, .commands-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
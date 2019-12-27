<template>
    <div>
        <OptionsCommand v-if="isOptionsStep"></OptionsCommand>
        <GameCommand v-else-if="step === 'playing'" :mode="mode" :step="step"></GameCommand>
        <RatingCommand v-else-if="step === 'rating'" :step="step"></RatingCommand>
        <div v-else-if="step == 'end'" class="buttons columns">
            <div class="column is-full">
                <button class="button is-success is-large is-fullwidth">Nouvelle partie</button>
            </div>
        </div>
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
</style>
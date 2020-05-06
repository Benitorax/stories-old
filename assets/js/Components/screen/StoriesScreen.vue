<template>
    <div>
        <StoriesOptions v-if="isOptionsStep" :parameters="parameters"></StoriesOptions>
        <StoriesGame v-else-if="step === 'playing'" :parameters="parameters"></StoriesGame>
        <StoriesRate v-else-if="step === 'rating'"></StoriesRate>
    </div>
</template>

<script>
    import StoriesOptions from './StoriesOptions';
    import StoriesGame from './StoriesGame';
    import StoriesRate from './StoriesRate';

    export default {
        components: { StoriesOptions, StoriesGame, StoriesRate},
        props: ['parameters', 'users'],
        computed: {
            isOptionsStep() {
                return ['start', 'startDice', 'selectSubject', 'freeSubject'].includes(this.step);
            },
            step() {
                return this.parameters.step;
            },
            mode() {
                return this.parameters.mode;
            },
            subject() {
                return this.parameters.subject;
            },
        }
    };
</script>

<style>
</style>
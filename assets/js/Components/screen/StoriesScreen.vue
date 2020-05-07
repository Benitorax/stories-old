<template>
    <div>
        <StoriesOptions v-if="step === 'start'" :parameters="parameters"></StoriesOptions>
        <StoriesGame v-else-if="step === 'play'" :parameters="parameters"></StoriesGame>
        <StoriesRate v-else-if="step === 'rate'"></StoriesRate>
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
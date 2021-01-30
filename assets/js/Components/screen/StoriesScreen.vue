<template>
    <div>
        <ParticipantsScreen v-if="step == 'wait'" :users="users"></ParticipantsScreen>
        <ResultScreen v-else-if="step == 'result'" :users="users"></ResultScreen>
        <MessageScreen v-else></MessageScreen>
    </div>
</template>

<script>
    import ParticipantsScreen from './ParticipantsScreen';
    import MessageScreen from './MessageScreen';
    import ResultScreen from './ResultScreen';

    export default {
        components: { MessageScreen, ResultScreen, ParticipantsScreen },
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
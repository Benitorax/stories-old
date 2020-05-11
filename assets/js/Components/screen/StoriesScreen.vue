<template>
    <div>
        <MessageScreen></MessageScreen>
    </div>
</template>

<script>
    import MessageScreen from './MessageScreen';


    export default {
        components: { MessageScreen},
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
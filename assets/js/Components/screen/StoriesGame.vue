<template>
    <div>
        <Message v-for="message in messages" :key="message.message" :message='message'></Message>
    </div>
</template>

<script>
    import Message from './Message';

    export default {
        components: { Message },
        props: ['parameters'],
        data() {
            return {
                messages: [],
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
            }
        },
        mounted() {
            Event.$on('game:message', (message) => this.addMessage(message));
            this.addMessage({
                message: this.subject, 
                colorClass: null, 
                iconClass: 'comment-dots'}
            );
        },
        methods: {
            addMessage(message) {
                this.messages.push({
                    message: message.message,
                    colorClass: message.colorClass,
                    iconClass: message.iconClass
                });
            },
        }
    };
</script>

<style>
    .message {
        margin-bottom: 5px !important;
    }
    .message-body {
        padding-bottom: 10px !important;
        padding-top: 10px !important;
    }
    .title {
        margin-bottom: 5px !important;
        margin-top: 5px !important;
    }
</style>
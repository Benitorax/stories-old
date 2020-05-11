<template>
    <div>
        <Message v-for="(message, index) in messages" :key="index" :message='message'></Message>
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
            Event.$on('message:add', (object) => this.addMessage(object.message, object.colorClass, object.iconClass));
            this.addMessage(this.subject, null, 'comment-dots'
            );
        },
        methods: {
            addMessage(message, colorClass = '', iconClass) {
                this.messages.push({
                    message: message,
                    colorClass: colorClass,
                    iconClass: iconClass
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
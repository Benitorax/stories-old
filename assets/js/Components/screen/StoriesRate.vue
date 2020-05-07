<template>
    <div>
        <Message v-for="message in messages" :key="message.message" :message='message'></Message>
    </div>
</template>

<script>
    import Message from './Message';

export default {
        components: { Message },
        data() {
            return {
                messages: [],
                count: 0
            }
        },
        mounted() {
            Event.$on('message:add', object => this.addMessage(object.message, object.colorClass, object.iconClass));
            this.addMessage('Lancez le dé pour vous noter.', '', 'paint-brush');
        },
        methods: {
            addMessage(message, colorClass = '', iconClass) {
                this.messages.push({
                    message: message,
                    colorClass: colorClass,
                    iconClass: iconClass
                });
                this.count +=1;
            }
        }
    };
</script>

<style>
</style>
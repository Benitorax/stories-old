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
            Event.$on('rating:dice', (message) => this.addMessage(message));
            this.messages.push({
                    message: 'Lancez le dé pour vous noter.',
                    colorClass: '',
                    iconClass: 'paint-brush'
                });
        },
        methods: {
            addMessage(message) {
                this.messages.push({
                    message: message.message,
                    colorClass: message.colorClass,
                    iconClass: message.iconClass
                });
                if(this.count === 0) {
                    this.messages.push({
                        message: 'Vos amis peuvent vous accorder un 2e lancer.',
                        colorClass: '',
                        iconClass: 'paint-brush'
                    });
                    this.messages.push({
                        message: 'ESPACE pour attribuer un 2e lancer.',
                        colorClass: '',
                        iconClass: 'paint-brush'
                    });
                }
                this.count +=1;
            }
        }
    };
</script>

<style>
</style>
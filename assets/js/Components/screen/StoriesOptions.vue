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
                selectedMode: null,
                isAlreadyFreeSubject: false,
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
            Event.$on('start:dice', (value) => this.updateDice(value.result));
            Event.$on('message:add', object => this.addMessage(object.message, object.colorClass, object.iconClass));
            this.addMessage('Bienvenue dans le jeu de dés pour raconter des aventures extraordinaires, drôles et magiques !', null, 'paint-brush');
            this.addMessage('Sélectionnez un mode de jeu.', null, 'file');
        },
        methods: {
            addMessage(message, colorClass = '', iconClass) {
                this.messages.push({
                    message: message,
                    colorClass: colorClass,
                    iconClass: iconClass
                });
            }
        }
    };
</script>

<style>
</style>
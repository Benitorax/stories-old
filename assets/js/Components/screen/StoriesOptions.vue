<template>
    <div>                
        <Message v-for="(message, index) in messages" :key="index" :message='message'></Message>
    </div>
</template>

<script>
    import Message from './Message';
    import DiceConverter from './../DiceConverter';

    export default {
        components: { Message },
        props: ['parameters'],
        data() {
            return {
                messages: [],
                selectedMode: null,
                dice1Value: null,
                dice2Value: null,
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
            Event.$on('parameters:update', (parameters) => this.checkNewOptions(parameters));
            Event.$on('message:add', object => this.addMessage(object.message, object.colorClass, object.iconClass));
            this.addMessage('Bienvenue dans le jeu de dés pour raconter des aventures extraordinaires, drôles et magiques !', null, 'paint-brush');
            this.addMessage('Sélectionnez un mode de jeu.', null, 'file');
        },
        methods: {
            addMessage(message, colorClass, iconClass) {
                this.messages.push({
                    message: message,
                    colorClass: colorClass,
                    iconClass: iconClass
                });
            },
            updateDice(value) {
                let dice = '';
                let number = '';
                if(this.dice1Value === null) {
                    dice = this.dice1Value = value;
                    number = 'premier';
                } else if(this.dice2Value === null) {
                    dice = this.dice2Value = value;
                    number = 'second';
                }
                this.addMessage('Résultat du ' + number + ' dé : ' + dice, null, 'dice-'+ DiceConverter.convertNumberToLetter(dice));
            },
            checkNewOptions(parameters) {
                // if(parameters.mode) {
                //     let mode = 'Normal';
                //     if(parameters.mode !== 'normal') mode = 'Avec dé blanc'
                //     this.addMessage('Mode "' + mode + '" sélectionné.', null, 'location-arrow');
                //     return;
                // }
            }
        }
    };
</script>

<style>
</style>
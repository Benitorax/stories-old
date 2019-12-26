<template>
    <div>                
        <Message v-for="message in messages" :key="message.message" :message='message'></Message>
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
                dice2Value: null
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
            this.addMessage('Sélectionnez le mode de jeu.', null, 'file');
        },
        methods: {
            addMessage(message, colorClass = '', iconClass) {
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
                this.addMessage('Résulat ' + number + ' dé : ' + dice, null, 'dice-'+ DiceConverter.convertNumberToLetter(dice));
            },
            checkNewOptions(parameters) {
                if(parameters.mode) {
                    let mode = 'Normal';
                    if(parameters.mode !== 'normal') mode = 'Dé blanc'
                    this.addMessage('Mode "' + mode + '" sélectionné.', null, 'location-arrow');
                    return;
                }

                if(parameters.step === 'freeSubject') {
                    this.addMessage('En attente du sujet.', null, 'spinner');
                    return;
                }

                if(parameters.step === 'selectSubject') {
                    this.addMessage('Sujet : ' + parameters.subject, 'yellow', 'comment-dots');
                    this.addMessage('Cliquez sur "Commencer" si vous êtes prêts, sinon optez pour un thème inventé par vos amis.', null, 'paint-brush');
                    return;
                }
            }
        }
    };
</script>

<style>
</style>
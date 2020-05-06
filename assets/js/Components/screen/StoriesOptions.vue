<template>
    <div>                
        <Message v-for="(message, index) in messages" :key="index" :message='message'></Message>
        <ModalSubject v-if="showModalSubject" @onSubmit="onSubmitModal"/>
    </div>
</template>

<script>
    import Message from './Message';
    import ModalSubject from './ModalSubject';
    import DiceConverter from './../DiceConverter';

    export default {
        components: { Message, ModalSubject },
        props: ['parameters'],
        data() {
            return {
                messages: [],
                selectedMode: null,
                dice1Value: null,
                dice2Value: null,
                isAlreadyFreeSubject: false,
                showModalSubject: false
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
            Event.$on('message:add', object => this.addMessage(object.message, '', object.iconClass));
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
                if(parameters.mode) {
                    let mode = 'Normal';
                    if(parameters.mode !== 'normal') mode = 'Avec dé blanc'
                    this.addMessage('Mode "' + mode + '" sélectionné.', null, 'location-arrow');
                    return;
                }

                if(parameters.step === 'freeSubject') {
                    setTimeout(() => this.showModalSubject = true, 2000);
                    this.isAlreadyFreeSubject = true;
                    this.addMessage('En attente du sujet.', null, 'spinner');
                    return;
                }

                if(parameters.step === 'selectSubject') {
                    this.addMessage('Sujet : ' + parameters.subject, 'yellow', 'comment-dots');
                    if(!this.isAlreadyFreeSubject) {
                        this.addMessage('Cliquez sur "Commencer" si vous êtes prêt(e), sinon optez pour un thème inventé par vos amis.', null, 'paint-brush');
                        this.isAlreadyFreeSubject = true;
                    }

                    return;
                }
            },
            onSubmitModal(subject) {
                this.showModalSubject = false;
                Event.$emit('parameters:update', { subject: subject, step: 'selectSubject' });
            }
        }
    };
</script>

<style>
</style>
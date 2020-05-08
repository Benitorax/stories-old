<template>
    <div class="buttons columns is-centered">
        <div v-if="showSelectMode" class="column is-full">
            <button class="button is-link is-large is-fullwidth" @click="onSelectMode('normal')">Normal</button>
            <button class="button is-info is-large is-fullwidth has-margin-top-2" @click="onSelectMode('whiteDice')">Avec dé blanc</button>
        </div>
        <div v-else-if="showThrowDice" class="column is-full">
            <button class="button is-primary is-large is-fullwidth" @click="onThrowDice">Lancer<i style="font-size: 25px;margin-left: 10px" class="fas fa-cube"></i></button>
        </div>
        <div v-else-if="showStartButton" class="column is-full">
            <div>
                <div class="buttons columns">
                    <div class="column is-full">
                        <button class="button is is-danger is-large is-fullwidth" @click="onClickStart">Commencer</button>
                    </div>
                    <div v-if="showFreeSubjectButton" class="column is-full has-margin-top-4">
                        <button class="button is-primary is-light is-large is-fullwidth" @click="onClickFreeSubject">Thème libre</button>
                    </div>
                </div>
            </div>
        </div>
        <SubjectModal v-if="showSubjectModal" @onSubmit="onSubmitModal"/>
    </div>
</template>

<script>
    import SubjectModal from './SubjectModal';
    import DiceConverter from './../DiceConverter';
    import Ajax from './../Ajax';

    export default {
        components: { SubjectModal },
        data() {
            return {
                rolledDiceCount: 0,
                dice1Value: null,
                showSelectMode: true,
                showThrowDice: false,
                showStartButton: false,
                showFreeSubjectButton: false,
                showSubjectModal: false
            }
        },
        methods: {
            onSelectMode(mode) {
                this.showSelectMode = false;
                Event.$emit('parameters:update', { mode: mode });
                let modeForMessage = 'Normal';
                if(mode !== 'normal') modeForMessage = 'Avec dé blanc'
                Event.$emit('message:add', { iconClass: 'location-arrow', message: 'Mode "' + modeForMessage + '" sélectionné.' });
                this.showThrowDice = true;
            },
            onThrowDice() {
                this.showThrowDice = false;
                Ajax.get('dice/number').then(({data}) => {
                    if(this.rolledDiceCount === 0) {
                        this.dice1Value = data.number;
                        this.writeRollDiceMessage('premier', data.number);
                        this.showThrowDice = true;
                    } else if(this.rolledDiceCount === 1) {
                        this.writeRollDiceMessage('second', data.number);
                        
                        if(data.number === this.dice1Value) {
                            Event.$emit('message:add', { iconClass: 'paint-brush', message: 'Vous avez fait un double. Les autres joueurs proposent un thème inventé.' });
                            Event.$emit('message:add', { iconClass: 'spinner', message: 'En attente du sujet.' });
                            setTimeout(() => this.displaySubjectModal(), 3000);

                        } else {
                            Ajax.get('subject').then(({data})=>{
                                Event.$emit('parameters:update', { subject: data.subject });
                                Event.$emit('message:add', { iconClass: 'comment-dots', colorClass: 'yellow', message: 'Sujet : ' + data.subject });
                                Event.$emit('message:add', { iconClass: 'paint-brush', message: 'Cliquez sur "Commencer" si vous êtes prêt(e), sinon optez pour un thème inventé par vos amis.' });
                                this.showStartButton = true;
                                this.showFreeSubjectButton = true;
                            });
                        }
                    }
                    this.rolledDiceCount += 1;
                });
            },
            writeRollDiceMessage(ordinalNumber, diceNumber) {
                Event.$emit('message:add', { iconClass: 'dice-'+ DiceConverter.convertNumberToLetter(diceNumber), message: 'Résultat du ' + ordinalNumber + ' dé : ' + diceNumber });
            },
            onClickStart() {
                Event.$emit('parameters:update', { step: 'play' });
            },
            onClickFreeSubject() {
                this.showFreeSubjectButton = false;
                Event.$emit('message:add', { iconClass: 'spinner', message: 'En attente du sujet.' });
                setTimeout(() => this.displaySubjectModal(), 1500);
            },
            displaySubjectModal() {
                this.showSubjectModal = true;
            },
            onSubmitModal(subject) {
                this.showSubjectModal = false;
                Event.$emit('parameters:update', { subject: subject });
                Event.$emit('message:add', { iconClass: 'comment-dots', colorClass: 'yellow', message: 'Sujet : ' + subject });
                this.showStartButton = true;
            }
        }
    }
</script>

<style>
</style>
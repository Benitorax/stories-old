<template>
    <div v-if="isShowed" class="buttons columns">
        <div v-if="showModeOptions" class="column is-full">
            <button class="button is-link is-large is-fullwidth" @click="onClickNormal">Normal</button>
            <button class="button is-info is-large is-fullwidth" @click="onClickWhiteDice">Avec dé blanc</button>
        </div>
        <div v-else-if="count < 2" class="column is-full">
            <button class="button is-primary is-large is-fullwidth" @click="onThrowDice">Lancer<i style="font-size: 25px;margin-left: 10px" class="fas fa-cube"></i></button>
        </div>
        <div v-else-if="count = 2" class="column is-full">
            <div>
                <div class="buttons columns">
                    <div class="column is-full">
                        <button class="button is is-danger is-large is-fullwidth" @click="onClickReady">Commencer</button>
                    </div>
                    <div v-if="!isFreeSubject" class="column is-full">
                        <button class="button is-primary is-light is-large is-fullwidth" @click="onClickFreeSubject">Thème libre</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Ajax from './../Ajax';
    export default {
        data() {
            return {
                showModeOptions: true,
                count: 0,
                dice1Value: null,
                dice2Value: null,
                isShowed: true,
                isFreeSubject: false
            }
        },
        methods: {
            onClickNormal() {
                this.hideTemporary();
                this.showModeOptions = false;
                Event.$emit('parameters:update', { mode: 'normal', step:'startDice' });
            },
            onClickWhiteDice() {
                this.hideTemporary();
                this.showModeOptions = false;
                Event.$emit('parameters:update', { mode: 'whiteDice', step:'startDice' });
            },
            onThrowDice() {
                this.isShowed = false;
                if(this.count ===0) {
                    this.hideTemporary();
                    this.count += 1;
                    Ajax.get('dice/number').then(({data}) => {
                        this.dice1Value = data.number;
                        Event.$emit('start:dice', { result: this.dice1Value });
                    });
                } else if(this.count ===1) {
                    this.count += 1;
                    Ajax.get('dice/number').then(({data}) => {
                        this.dice2Value = data.number;
                        Event.$emit('start:dice', { result: this.dice2Value });
                        
                        if(this.dice2Value === this.dice1Value) {
                            this.hideLonger();
                            this.emitFreeSubjectStep()
                        } else {
                            this.hideTemporary();
                            Ajax.get('subject').then(({data})=>{
                                Event.$emit('parameters:update', { subject: data.subject, step: 'selectSubject' });
                            });
                        }
                    });
                }       
            },
            onClickReady() {
                this.hideTemporary();
                Event.$emit('parameters:update', { step: 'playing' });
            },
            onClickFreeSubject() {
                this.emitFreeSubjectStep();
            },
            emitFreeSubjectStep() {
                this.hideLonger()
                this.isFreeSubject = true;
                Event.$emit('parameters:update', { step: 'freeSubject' });

            },
            hideTemporary() {
                this.isShowed = false;
                setTimeout(() => this.isShowed = true, 800);
            },
            hideLonger() {
                this.isShowed = false;
                setTimeout(() => this.isShowed = true, 3000);
            }
        }
    }
</script>

<style>
</style>
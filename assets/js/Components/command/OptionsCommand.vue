<template>
    <div v-if="isShowed" class="buttons columns">
        <div v-if="showModeOptions" class="column is-full">
            <button class="button is-primary is-large is-fullwidth" @click="onClickNormal">Normal</button>
            <button class="button is-link is-large is-fullwidth" @click="onClickWhiteDice">Avec dé blanc</button>
        </div>
        <div v-else-if="count < 2" class="column is-full">
            <button class="button is-primary is-large is-fullwidth" @click="onThrowDice">Lancer<i style="font-size: 25px;margin-left: 10px" class="fas fa-cube"></i></button>
        </div>
        <div v-else-if="count = 2" class="column is-full">
            <div v-if="!dicesOdd">
                <div class="buttons columns">
                    <div class="column is-full">
                        <button class="button is is-primary is-large is-fullwidth" @click="onClickReady">Commencer</button>
                    </div>
                    <div class="column is-full">
                        <button class="button is-link is-large is-fullwidth" @click="onClickFreeSubject">Thème libre</button>
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
                dicesOdd: false,
                isShowed: true
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
                this.hideTemporary();
                if(this.count ===0) {
                    this.count += 1;
                    this.dice1Value = Math.floor(Math.random() * 6) + 1;
                    Event.$emit('start:dice', { result: this.dice1Value });
                } else if(this.count ===1) {
                    this.count += 1;
                    this.dice2Value = Math.floor(Math.random() * 6) + 1;
                    Event.$emit('start:dice', { result: this.dice2Value });
                    
                    if(this.dice2Value === this.dice1Value) {
                        this.dicesOdd = true;
                        this.emitFreeSubjectStep();
                    } else {
                        Ajax.get('subject').then(({data})=>{
                            console.log('response', data);
                            Event.$emit('parameters:update', { subject: data.subject, step: 'selectSubject' });
                        }).catch(()=> console.log('error from fetching subject'));
                    }
                }       
            },
            onClickReady() {
                this.hideTemporary();
                Event.$emit('parameters:update', { step: 'playing' });
            },
            onClickFreeSubject() {
                this.hideTemporary();
                this.emitFreeSubjectStep()
            },
            emitFreeSubjectStep() {
                this.hideDefinitively()
                Event.$emit('parameters:update', { step: 'freeSubject' });
                // TODO AJAX for MERCURE, audience will have to write a new subject

            },
            hideTemporary() {
                this.isShowed = false;
                setTimeout(() => this.isShowed = true, 500);
            },
            hideDefinitively() {
                this.isShowed = false;
            }
        }
    }
</script>

<style>
</style>
<template>
    <div style="margin-top: 25px" class="container">
        <div class="columns">
            <div class="column is-8 screen has-background-grey-light">
                <StoriesScreen :parameters="parameters"></StoriesScreen>
            </div>
            <div class="column command">
                <Command :parameters="parameters"></Command>
            </div>
        </div>
    </div>
</template>

<script>
    /* list of steps: start, selectMode, startDice, selectSubject, playing, rating*/
    import StoriesScreen from './screen/StoriesScreen';
    import Command from './command/Command';

    export default {
        components: { StoriesScreen, Command },
        data() {
            return {
                parameters: {
                    step: 'start',
                    mode: '',
                    subject: ''
                }
            }
        },
        mounted() {
            Event.$on('parameters:update', (object) => this.updateParameters(object));
        },
        methods: {
            updateParameters(object) {
                console.log('Update:', object);
                this.parameters = Object.assign({}, this.parameters, object);
            }
        }
    };
</script>

<style>
    .screen {
        border: solid 2px black;
        min-height: 90vh;
    }
    .command {
        border: solid 2px grey;
        min-height: 90vh;
        width: 500px !important;
    }
</style>
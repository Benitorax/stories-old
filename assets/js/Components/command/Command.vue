<template>
    <div>
        <div class="card has-margin-bottom-5">
            <div class="card-content">
                <div class="media">
                    <div class="media-left has-text-link"><i class="fas fa-user fa-3x"></i></div>
                    <div class="media-content">
                        <div class="title is-3"> {{ user.username }}</div>    
                    </div>
                </div>
            </div>
        </div>
        <transition name="commands">
            <OptionsCommand v-if="isOptionsStep"></OptionsCommand>
            <GameCommand v-else-if="step === 'playing'" :mode="mode" :step="step"></GameCommand>
            <RatingCommand v-else-if="step === 'rating'" :user="user" :users="users" :step="step"></RatingCommand>
        </transition>
    </div>
</template>

<script>
    import GameCommand from './GameCommand';
    import OptionsCommand from './OptionsCommand';
    import SelectModeCommand from './SelectModeCommand';
    import RatingCommand from './RatingCommand';

    export default {
        components: { 
            GameCommand,
            OptionsCommand,
            SelectModeCommand,
            RatingCommand
        },
        props: ['parameters', 'user', 'users'],
        computed: {
            step() {
                return this.parameters.step;
            },
            mode() {
                return this.parameters.mode;
            },
            subject() {
                return this.parameters.subject;
            },
            isOptionsStep() {
                return ['start', 'startDice', 'selectSubject', 'freeSubject'].includes(this.parameters.step);
            }
        }
    };
</script>

<style>
    .commands-enter-active {
        transition: opacity 1.5s;
    }   
    .commands-enter, .commands-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
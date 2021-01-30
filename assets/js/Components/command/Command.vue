<template>
    <div>
        <div v-if="isPlayerSelected" class="card">
            <div class="card-content is-hidden-mobile">
                <div class="media">
                    <div class="media-left has-text-link"><i class="fas fa-user fa-3x"></i></div>
                    <div class="media-content">
                        <div class="title is-3"> {{ user.username }}</div>    
                    </div>
                </div>
            </div>
            <div style="padding: 10px" class="is-hidden-tablet">
                <div class="media">
                    <div class="media-left has-text-link"><i class="fas fa-user fa-2x"></i></div>
                    <div class="media-content">
                        <div class="title is-6"> {{ user.username }}</div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="has-margin-bottom-5 is-hidden-mobile"></div>
        <div style="min-height: 5px" class="is-hidden-tablet"></div>
        <transition name="commands">
            <UserForm v-if="step === 'wait'" :users="users"></UserForm>
            <OptionsCommand v-else-if="step === 'start'"></OptionsCommand>
            <GameCommand v-else-if="step === 'play'" :parameters="parameters"></GameCommand>
            <RatingCommand v-else-if="step === 'rate'" :user="user" :users="users" :step="step"></RatingCommand>
            <ResultCommand v-else-if="step === 'result'" :users="users"></ResultCommand>
        </transition>
    </div>
</template>

<script>
    import GameCommand from './GameCommand';
    import OptionsCommand from './OptionsCommand';
    import RatingCommand from './RatingCommand';
    import UserForm from './UserForm';
    import ResultCommand from './ResultCommand';

    export default {
        components: { 
            GameCommand,
            OptionsCommand,
            RatingCommand,
            UserForm,
            ResultCommand
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
            isPlayerSelected() {
                return !['wait', 'result'].includes(this.parameters.step);
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
<template>
    <div style="margin-top: 25px" class="container">
        <div v-if="showDashboard" class="columns">
            <div class="column">
                <Dashboard :step="parameters.step" :users="users"></Dashboard> 
            </div>
        </div>

        <div v-else class="columns">
            <div class="column is-8 screen has-background-grey-light">
                <StoriesScreen :users="users" :parameters="parameters"></StoriesScreen>
            </div>
            <div class="column command">
                <Command :user="user" :users="users" :parameters="parameters"></Command>
            </div>
        </div>
    </div>
</template>

<script>
    /* list of steps: waiting, start, playing, rating, result */
    import StoriesScreen from './screen/StoriesScreen';
    import Command from './command/Command';
    import Dashboard from './dashboard/Dashboard';

    export default {
        components: { StoriesScreen, Command, Dashboard },
        data() {
            return {
                parameters: {
                    step: 'start',
                    mode: '',
                    subject: ''
                },
                users: [
                    {id:1, username: 'Hervé', points:0, try:0 },
                    {id:2, username: 'Bernard', points:0, try:0 }
                ],
                user: {
                    id:1, username: 'Hervé', points:0, try:0 
                }
            }
        },
        computed: {
            showDashboard() {
                return ['waiting', 'result'].find(element => element == this.parameters.step);
            }
        },
        mounted() {
            Event.$on('parameters:update', (object) => this.updateParameters(object));
            Event.$on('users:update', (object) => this.updateUsers(object))
            Event.$on('user:update', (object) => this.updateUser(object))
        },
        methods: {
            updateParameters(object) {
                if(object.step =='start') {
                    let users = this.users.filter(user => user.points == '');
                    if(users.length == 0) {
                        this.parameters = Object.assign({}, this.parameters, {step: 'result', mode:'', subject:''});
                        this.user = {};
                    }
                    else {
                        this.user = users[Math.floor(Math.random() * users.length)];
                        this.parameters = Object.assign({}, this.parameters, object);
                    }
                }
                else this.parameters = Object.assign({}, this.parameters, object);
            },
            updateUsers(data) {
                this.users = Object.assign([], data.users);
            },
            updateUser(data) {
                this.user = Object.assign([], this.user, data);
                let users = this.users.map(user => {
                    if(user.id == this.user.id) return Object.assign({}, this.user);
                    return user;
                });
                this.updateUsers({users: users});
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
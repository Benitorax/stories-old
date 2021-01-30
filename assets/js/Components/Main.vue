<template>
    <div style="margin-top: 25px" class="container is-fluid">
        <div class="columns">
            <div class="column is-8">
                <StoriesScreen :users="users" :parameters="parameters"></StoriesScreen>
            </div>
            <div class="column command">
                <Command :user="user" :users="users" :parameters="parameters"></Command>
            </div>
        </div>
    </div>
</template>

<script>
    /* list of steps: wait, start, play, rate, result */
    import StoriesScreen from './screen/StoriesScreen';
    import Command from './command/Command';

    export default {
        components: { StoriesScreen, Command },
        data() {
            return {
                parameters: {
                    step: 'wait',
                    mode: '',
                    subject: ''
                },
                users: [],
                user: {}
            }
        },
        computed: {
            showDashboard() {
                return ['wait', 'result'].find(element => element == this.parameters.step);
            }
        },
        mounted() {
            Event.$on('parameters:update', (object) => this.updateParameters(object));
            Event.$on('users:update', (object) => this.updateUsers(object))
            Event.$on('users:add', (object) => this.addUsers(object))
            Event.$on('users:remove', (object) => this.removeUsers(object))
            Event.$on('user:update', (object) => this.updateUser(object))
        },
        methods: {
            updateParameters(object) {
                if(object.step =='start') {
                    let users = this.users.filter(user => user.points == '');
                    this.user = users[Math.floor(Math.random() * users.length)];
                } else if(object.step =='result') {
                    this.user = {};
                }
                this.parameters = Object.assign({}, this.parameters, object);
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
            },
            addUsers(data) {
                this.users.push(data.user);
            },
            removeUsers(data) {
                this.users = this.users.filter(user => user.id !== data.user.id);
            }
        }
    };
</script>

<style>
</style>
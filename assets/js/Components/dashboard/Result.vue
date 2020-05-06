<template>
    <div class="columns">
        <div class="column is-8 screen has-background-grey-light">
            <table class="table is-hoverable is-striped is-fullwidth subtitle is-4">
                <thead>
                    <tr>
                        <th colspan="4" class="title is-3">Classement</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Joueur</th>
                        <th>Points</th>
                        <th>Tentative</th>
                    </tr>
                </thead>
                <tbody>
                    <tr :class="{ first: isFirst(user), last: isLast(user) }" v-for="(user, index) in sortedUsers" :key="user.id">
                        <td>{{ index + 1 }}</td>
                        <td>
                            <i v-if="isFirst(user)" class="fas fa-trophy has-text-trophy"></i>
                            <i v-if="isLast(user)" class="fas fa-poo has-text-poo"></i>
                            <b>{{ user.username }}</b>
                        </td>
                        <td><b>{{ user.points }}</b></td>
                        <td><b>{{ user.try }}</b></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="column command">
            <div class="columns">
                <div class="column has-margin-top-1">
                    <button v-on:click="restartGame" class="button is-info is-large is-fullwidth">Rejouer</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['users'],
    data() {
        return {
            username: ''
        };
    },
    computed: {
        sortedUsers() {
            return this.users.sort((a, b) => {
                if(b.points != a.points) return b.points - a.points;
                else return a.try - b.try; 
            });
        }
    },
    methods: {
        restartGame() {
            let users = this.users.map(user => Object.assign(user, {points: '', try: ''}))
            Event.$emit('users:update', { users });
            Event.$emit('parameters:update', { step: 'waiting' });
        },
        isFirst(user) {
            let users = this.sortedUsers;
            let first = users[0];
            if(user.points == first.points && user.try == first.try) return true;
            else return false;
        },
        isLast(user) {
            let users = this.sortedUsers;
            let last = users[users.length-1];
            if(user.points == last.points && user.try == last.try) return true;
            else return false;
        }
    }
}
</script>

<style>
.first{
    background-color: rgb(13, 206, 90) !important;
    color: white !important;
}
.last {
    background-color: rgb(202, 32, 32) !important;
    color: white !important;
}
.screen {
    border: solid 2px black;
    min-height: 90vh;
}
.command {
    border: solid 2px grey;
    min-height: 90vh;
    width: 500px !important;
}
.has-text-poo {
    color: #DA9F02;
}
.has-text-trophy {
    color: rgb(255, 252, 96);
}
td {
    vertical-align: middle !important;
}
</style>
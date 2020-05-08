<template>
    <div class="columns">
        <div class="column is-8 screen has-background-grey-light">
            <table class="table is-hoverable is-fullwidth subtitle is-4">
                <thead>
                    <tr>
                        <td colspan="3" class="title is-3">Liste des participants</td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Joueur</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users" :key="user.id">
                        <td>{{ index + 1 }}</td>
                        <td><b>{{ user.username }}</b></td>
                        <td><button v-on:click="deletePlayer(user.id)" class="button is-medium is-danger"><i class="fas fa-trash has-margin-right-7"></i>Retirer</button></td>
                    </tr>
                    <tr v-if="users.length ==0">
                        <td></td>
                        <td colspan="2">Ajoutez des joueurs</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="column command">
            <div class="columns">
                <div class="column has-margin-top-1">
                    <form v-on:submit.prevent="addPlayer">
                        <div class="field has-addons">
                            <div class="control">
                                <input ref="username" class="input is-large" type="text" placeholder="Nom joueur" v-model="username" maxlength="15" />
                            </div>
                            <div class="control">
                                <button :disabled="username.length < 1" class="button is-info is-large">Ajouter</button>
                            </div>
                        </div>
                    </form>
                    <div class="has-margin-top-1">
                        <button :disabled="users.length < 2" v-on:click="startGame" class="button is-success is-large is-fullwidth">Démarrer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['users', 'step'],
    data() {
        return {
            username: ''
        };
    },
    methods: {
        addPlayer: function() {
            let user = {
                id: this.id(),
                username: this.username.substr(0,15),
                points: '',
                try: ''
            };
            this.users.push(user);
            Event.$emit('users:update', { users : this.users });
            this.username = '';
            this.$refs.username.focus();
        },
        deletePlayer: function(id) {
            let users = this.users.filter(user => user.id !== id);
            Event.$emit('users:update', { users });
        },
        id: function() {
            return '_' + Math.random().toString(36).substr(2, 9);
        },
        startGame: function() {
            Event.$emit('parameters:update', { step: 'start' });
        }
    },
    mounted() {
        this.$refs.username.focus();
    }
}
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
td {
    vertical-align: middle !important;
}
</style>
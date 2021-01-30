<template>
    <table class="table is-hoverable is-fullwidth subtitle is-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Joueurs</th>
                <th>
                    <span class="is-hidden-mobile">Options</span>
                    <span class="is-hidden-tablet" style="padding-left: 15px"><i class="fas fa-cog"></i></span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(user, index) in users" :key="user.id">
                <td>{{ index + 1 }}</td>
                <td><b>{{ user.username }}</b></td>
                <td>
                    <button v-on:click="deletePlayer(user)" class="button is-medium is-danger">
                        <span class="is-hidden-mobile has-margin-right-7">Retirer</span><i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            <tr v-if="users.length ==0">
                <td colspan="3">Ajoutez des joueurs</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ['users', 'step'],
    methods: {
        deletePlayer(user) {
            Event.$emit('users:remove', { user });
        }
    },
}
</script>

<style>
td {
    vertical-align: middle !important;
}
</style>
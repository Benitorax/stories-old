<template>
    <div>
        <button v-on:click="restartGame" class="button is-info is-large is-fullwidth">Rejouer</button>
    </div>
</template>

<script>
export default {
    props: ['users'],
    methods: {
        restartGame() {
            let users = this.users.map(user => Object.assign(user, {points: '', try: ''}))
            Event.$emit('users:update', { users });
            Event.$emit('parameters:update', { step: 'wait' });
        },
    }
}
</script>

<style>

</style>
<template>
    <div class="container">
        <button class="button is-primary is-large is-fullwidth" @click="onBlackDice">Lancer dé noir</button>
    </div>
</template>

<script>
    import Ajax from './Ajax';

    export default {
        methods: {
            onBlackDice() {
                Ajax.post('dice/black', {
                    token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InB1Ymxpc2giOltdfX0.Oo0yg7y4yMa1vr_bziltxuTCqb8JVHKxp-f_FwwOim0
                })
                .then(({data}) => console.log('response from black dice'))
                .catch(() => console.log('error from black dice'));
            }
        }
    }
</script>

<style>
    
</style>
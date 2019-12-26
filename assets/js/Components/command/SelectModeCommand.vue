<template>
    <div class="buttons columns">
        <div class="column is-full">
            <button class="button is-primary is-large is-fullwidth" @click="onClickNormal">Normal</button>
        </div>
        <div class="column is-full">
            <button class="button is-link is-large is-fullwidth" @click="onClickWhiteDice">Avec dé blanc</button>
        </div>
    </div>
</template>

<script>
    import Ajax from './../Ajax';

    export default {
        methods: {
            onClickNormal() {
                Event.$emit('parameters:update', { mode: 'normal', step:'startDice' });
            },
            onClickWhiteDice() {
                Event.$emit('parameters:update', { mode: 'whiteDice', step:'startDice' });
            }
        }
    };
</script>

<style>
</style>
<template>
    <div @click="focusOnInput" class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Entrez votre sujet</p>
            </header>
            <section class="modal-card-body">
                <textarea v-model="subject" id="textarea-field" rows="2" maxlength="125" @keyup.ctrl.enter="onSubmit" class="textarea is-medium app-input" type="text" autofocus/>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success">CTRL + ENTREE pour valider</button>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                subject: ''
            }
        },
        methods: {
            onSubmit() {
                this.$emit('onSubmit', this.subject.trim());
            },
            focusOnInput() {
                document.getElementById('textarea-field').focus();
            }
        },
        mounted() {
            this.focusOnInput();
        }
    }
</script>

<style scoped>
</style>
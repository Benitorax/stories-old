<template>
    <div @click="focusOnInput" class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <div class="modal-card-title">
                    <p class="title">Entrez votre sujet</p>
                </div>
            </header>
            <section class="modal-card-body">
                <textarea v-model="subject" id="textarea-field" rows="2" maxlength="125" @keyup.ctrl.enter="onSubmit" class="textarea is-medium app-input" type="text" autofocus/>
                <p v-if="showErrorMessage" class="help is-danger subtitle is-4">Vous devez saisir le nouveau sujet</p>
            </section>
            <footer class="modal-card-foot columns is-centered">
                <button class="button is-success is-large is-hidden-mobile">CTRL + ENTREE pour valider</button>
                <button class="button is-success is-large is-hidden-tablet" @click="onSubmit">Valider</button>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                subject: '',
                showErrorMessage: false
            }
        },
        methods: {
            onSubmit() {
                if(this.subject.trim().length == 0) { 
                    document.getElementById('textarea-field').focus(); 
                    this.showErrorMessage = true;
                    return; 
                }

                this.showErrorMessage = false;
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
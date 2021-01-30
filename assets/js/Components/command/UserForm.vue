<template>
    <div>
        <div>
            <form v-on:submit.prevent="addPlayer">
                <div class="field has-addons">
                    <div class="control is-expanded">
                        <input ref="username" class="input is-large" type="text" placeholder="Nom" v-model="username" maxlength="15"/>
                    </div>
                    <div class="control">
                        <button :disabled="username.length < 1" class="button is-info is-large">
                            <span class="is-hidden-mobile">Ajouter</span><i class="fas fa-plus is-hidden-tablet"></i>
                        </button>
                    </div>
                </div>
                <p v-if="showErrorMessage" class="help is-danger subtitle is-4">Ce nom est déjà utilisé</p>
            </form>
        </div>

        <div style="margin-top: 25px">
            <button :disabled="users.length < 2" v-on:click="startGame" class="button is-success is-large is-fullwidth">Démarrer</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['users', 'step'],
    data() {
        return {
            username: '',
            showErrorMessage: false
        };
    },
    methods: {
        addPlayer() {
            if(this.username.trim().length == 0) { this.$refs.username.focus(); return } 
            if(!this.isUniqueUsername()) { this.showErrorMessage = true; return }
            else this.showErrorMessage = false;

            let user = {
                id: this.id(),
                username: this.username.trim().substr(0,15),
                points: '',
                try: ''
            };
            Event.$emit('users:add', { user });
            this.username = '';
            this.$refs.username.focus();
        },
        id() {
            return '_' + Math.random().toString(36).substr(2, 9);
        },
        startGame() {
            Event.$emit('parameters:update', { step: 'start' });
        },
        isUniqueUsername() {
            let isUnique = true;
            this.users.forEach(user => {
                if(user.username.toLowerCase() == this.username.trim().toLowerCase()) isUnique = false;
            });
            return isUnique;
        }
    },
    mounted() {
        this.$refs.username.focus();
    }
}
</script>

<style>

</style>
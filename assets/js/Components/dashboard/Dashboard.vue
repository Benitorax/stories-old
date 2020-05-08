<template>
    <Result v-if="step == 'result'" :users="users"></Result>
    <UserForm v-else :users="users"></UserForm>
</template>

<script>
import Result from './Result';
import UserForm from './UserForm';

export default {
    components: { Result, UserForm },
    props: ['users', 'step']
}
</script>

<style>

</style>
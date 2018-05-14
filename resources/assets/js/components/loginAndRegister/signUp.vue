<template>
    <card>
        <EditProfileForm></EditProfileForm>
    </card>
</template>

<script>
    import Card from '../Cards/Card'
    import EditProfileForm from '../Views/EditProfileForm'
    export default {
        name: "sign-up",
        components: {
            Card,
            EditProfileForm
        }
    }
</script>

<style scoped>

</style>
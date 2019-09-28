<template>
    <layout>
        <h1 class="title">{{ title }}</h1>

        <custom-form v-model="user" :fields="userFields" />
    </layout>
</template>

<script>
    export default {
        name: 'users-detail',

        props: {
            data: {
                type: Object,
            },
            isCreate: {
                type: Boolean,
                default: false,
            }
        },

        data() {
            return {
                user: {},
                title: 'New user',
                userFields: [
                    {label: 'Name', key: 'name', type: 'string'},
                    {label: 'E-mail address', key: 'email', type: 'string'},
                ]
            }
        },

        created() {
            if (this.isCreate) {
                this.user = {};
            } else {
                this.user = this.data;
                this.title = `Edit user: ${this.user.name}`;
            }
        },

        methods: {

        },

    }
</script>

<style lang="scss" scoped>

</style>

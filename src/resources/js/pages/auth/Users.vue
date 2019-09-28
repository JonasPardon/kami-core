<template>
    <layout>
        <h1 class="title">Users</h1>

        <div class="page-actions">
            <div class="btn-page-action">
                <custom-btn icon="plus" @click="addItem">New user</custom-btn>
            </div>
        </div>

        <data-table :headers="headers" :data="users" editable @editItem="editItem"/>
    </layout>
</template>

<script>
    export default {
        name: 'users',

        props: {
            users: {
                type: Array,
                required: true,
            },
        },

        data() {
            return {
                headers: [
                    {label: 'Name', key: 'name'},
                    {label: 'E-mail', key: 'email'},
                    {label: 'Created at', key: 'created_at', type: 'date'},
                ],
            }
        },

        methods: {
            editItem(item) {
                this.$inertia.visit(`/admin/auth/users/${item.id}`);
            },

            deleteItem(item) {
                alert(item.id);
            },

            addItem() {
                this.$inertia.visit('/admin/auth/users/new');
            }
        }
    }
</script>

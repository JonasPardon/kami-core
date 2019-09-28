<template>
    <layout>
        <h1 class="title">
            Pages
        </h1>

        <div class="page-actions">
            <div class="btn-page-action">
                <custom-btn icon="plus" @click="addItem">New page</custom-btn>
            </div>
        </div>

        <div class="content">
            <data-table :headers="headers" :data="mappedPages" editable deletable
                @editItem="editItem" @deleteItem="deleteItem" />
        </div>

    </layout>
</template>

<script>
    import moment from "moment";

    export default {
        name: 'pages',

        props: {
            pages: {
                type: Array,
                required: true,
            },
        },

        data() {
            return {
                headers: [
                    {label: 'Title', key: 'title', type: 'string'},
                    {label: 'Slug', key: 'slug', type: 'string'},
                    {label: 'Active', key: 'active', type: 'boolean'},
                    {label: 'Published', key: 'currently_published', type: 'boolean'},
                    {label: 'Created at', key: 'created_at', type: 'date'},
                ],
            }
        },

        methods: {
            editItem(item) {
                this.$inertia.visit(`/admin/pages/${item.id}`);
            },

            deleteItem(item) {
                alert(`delete item ${item.slug}`);
            },

            addItem() {
                this.$inertia.visit('/admin/pages/new');
            }
        },

        computed: {
            mappedPages() {
                return this.pages.map(page => {
                    return {
                        ...page,
                        currently_published: () => {
                            if (!page.publish_at && !page.publish_until) return true;
                            if ((moment(page.publish_until) > moment()) && (moment(page.publish_at) < moment())) {
                                return true;
                            }
                            return false;
                        },
                    }
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .content {
        width: 100%;
    }
</style>

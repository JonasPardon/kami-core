<template>
    <layout>
        <h1 class="title">{{ title }}</h1>

        <div class="page-actions">
            <div class="btn-page-action">
                <custom-btn @click="showPreview" icon="eye">Preview</custom-btn>
            </div>

            <div class="btn-page-action">
                <custom-btn @click="savePage" icon="save">Save</custom-btn>
            </div>
        </div>

        <custom-form v-model="page" :fields="pageFields" />

        <div :class="{preview: true, active: preview !== null}">
            <div class="preview__header">
                <p>Page preview</p>

                <font-awesome-icon icon="times" @click="closePreview" />
            </div>
            <iframe :srcdoc="preview" frameborder="0"></iframe>
        </div>
    </layout>
</template>

<script>
    import toastMixin from "@kami-core/mixins/toastMixin";

    export default  {
        name: 'page-detail',

        mixins: [
            toastMixin,
        ],

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
                page: {},
                title: 'New page',
                pageFields: [
                    {label: 'Title', key: 'title', type: 'string'},
                    {label: 'Body', key: 'body', type: 'text'},
                    {label: 'Active', key: 'active', type: 'boolean'},
                    {label: 'Publish at', key: 'publish_at', type: 'datetime'},
                    {label: 'Publish until', key: 'publish_until', type: 'datetime'},
                    // {label: 'Created at', key: 'created_at', type: 'datetime'},
                ],
                preview: null,
            }
        },

        created() {
            if (this.isCreate) {
                this.page = {};
            } else {
                this.page = this.data;
                this.title = this.page.title;
            }
        },

        methods: {
            savePage() {
                const url = this.isCreate ? '/admin/pages' : `/admin/pages/${this.page.id}`;

                axios.post(url, this.page)
                    .then(response => {
                        this.successToast('Successfully saved');
                    })
                    .catch(error => {
                        this.errorToast('Something went wrong');
                    });
            },

            showPreview() {
                axios.post('/admin/preview', {
                    target_entity: 'page',
                    model: 'App\\Page',
                    data: this.page
                }).then(response => {
                        this.preview = response.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },

            closePreview() {
                this.preview = null;
            },
        }
    }
</script>

<style lang="scss" scoped>
    .preview {
        position: fixed;
        top: 10rem;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        background-color: white;
        z-index: -1;
        transition: all .2s ease;

        iframe {
            width: 100%;
            height: 100%;
        }

        &.active {
            top: 0;
            opacity: 1;
            z-index: 999;
        }

        &__header {
            font-size: 1.8rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem 3rem;
            width: 100%;
            background-color: rgb(57, 64, 73);
            color: white;

            p {
                margin-bottom: 0;
            }

            svg {
                transition: all .2s ease;

                &:hover {
                    transform: scale(1.2);
                    cursor: pointer;
                }
            }
        }
    }
</style>

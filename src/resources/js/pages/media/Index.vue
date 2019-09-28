<template>
    <layout>
        <h1 class="title">Media library</h1>

        <vue-dropzone ref="dropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="dropzoneFileAdded"></vue-dropzone>

        <data-table :headers="tableHeaders" :data="mappedMedia" editable deletable />

    </layout>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.min.css';
    import toastMixin from "./../../mixins/toastMixin";

    export default {
        name: 'media-library',

        components: {
            'vue-dropzone': vue2Dropzone,
        },

        mixins: [
            toastMixin,
        ],

        props: {
            data: {
                type: Array,
                required: true,
            }
        },

        data() {
            return {
                tableHeaders: [
                    {label: 'Image', key: 'image_url', type: 'image'},
                    {label: 'Name', key: 'name'},
                    {label: 'File name', key: 'file_name'},
                    {label: 'Type', key: 'mime_type'},
                    {label: 'Created', key: 'created_at'},
                ],
                media: [],
                mappedMedia: [],
                dropzoneOptions: {
                    url: '/admin/media',
                    thumbnailWidth: 150,
                    maxFilesize: 1.5,
                    headers: { "X-CSRF-TOKEN": window.laravel.csrfToken }
                }
            }
        },

        created() {
            this.media = this.data;
            this.mapMedia();
        },

        methods: {
            mapMedia() {
                this.mappedMedia = this.media.map(img => {
                    return {
                        ...img,
                        image_url: `/storage/${img.id}/${img.file_name}`,
                    }
                });
            },

            dropzoneFileAdded(file, response) {
                this.$refs.dropzone.removeAllFiles();
                this.media.unshift(response);
                this.mapMedia();
                this.successToast('Successfully uploaded');
            }
        }
    }
</script>

<style>

</style>

<template>
    <layout>
        <h1 class="title">Settings</h1>

        <div class="page-actions">
            <div class="btn-page-action">
                <custom-btn @click="saveSettings" icon="save">Save</custom-btn>
            </div>
        </div>

        <div class="category" v-for="(category, categoryName) in settings">

            <h2 class="subtitle">{{ categoryName }}</h2>

            <div class="category__setting" v-for="setting in category" :key="setting.id">
                {{ setting.label }}

                <template v-if="setting.type === 'string'">
                    <input type="text" v-model="setting.value">
                </template>

                <template v-if="setting.type === 'boolean'">
                    <toggle v-model="setting.value" />
                </template>
            </div>
        </div>
    </layout>
</template>

<script>
    import Toggle from './../../components/fields/Toggle';
    import toastMixin from "./../../mixins/toastMixin";

    export default {
        name: 'settings',

        components: {
            'toggle': Toggle,
        },

        mixins: [
            toastMixin,
        ],

        props: {
            data: {
                type: Object,
                required: true,
            }
        },

        data() {
            return {
                settings: this.data,
            }
        },

        methods: {
            saveSettings() {
                axios.post('/admin/settings', this.settings)
                    .then(response => {
                        this.successToast('Successfully saved');
                    })
                    .catch(error => {
                        this.errorToast('Something went wrong');
                    });
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>

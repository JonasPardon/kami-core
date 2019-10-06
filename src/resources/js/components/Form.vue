<template>
    <div class="custom-form">
        <table>
            <tr v-for="field in fields" :key="field.key" class="custom-form__row">
                <td class="custom-form__row__label" valign="top">
                    <label :for="'form_${field.key}'"></label>{{ field.label }}
                </td>
                <td class="custom-form__row__value">

                    <template v-if="field.type === 'string'">
                        <input type="text" v-model="data[field.key]" :id="'form_${field.key}'" :name="'form_${field.key}'">
                    </template>

                    <template v-if="field.type === 'date' || field.type === 'datetime'">
<!--                        <v-date-picker v-model="data[field.key]"/>-->
                        <datetime v-model="data[field.key]" type="datetime" />
                    </template>

                    <template v-if="field.type === 'text'">
                        <markdown v-model="data[field.key]" />
                    </template>

                    <template v-if="field.type === 'boolean'">
                        <toggle v-model="data[field.key]" />
                    </template>

                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    import {Datetime} from 'vue-datetime';
    import VueSimplemde from 'vue-simplemde';
    import Toggle from './fields/Toggle';

    export default {
        name: 'custom-form',

        components: {
            'datetime': Datetime,
            'markdown': VueSimplemde,
            'toggle': Toggle,
        },

        props: {
            fields: {
                type: Array,
                required: true,
            },
            value: {
                type: Object,
            },
        },

        data() {
            return {
                data: {},
            }
        },

        created() {
            this.data = this.value;
        },

        watch: {
            data: {
                deep: true,
                handler() {
                    this.$emit('input', this.data);
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .custom-form {
        table {
            width: 100%;
        }

        &__row {
            td {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }

            &__label {
                text-align: right;
                padding-right: 1rem;
                padding-top: 2rem;
            }

            &__value {
                padding-left: 1rem;
            }
        }
    }
</style>

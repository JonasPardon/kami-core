<template>
    <toggle-button v-model="boolValue" :value="boolValue"/>
</template>

<script>
    export default {
        name: 'toggle',

        props: {
            value: {}
        },

        data() {
            return {
                boolValue: false,
            }
        },

        created() {
            this.boolValue = this.value === true || this.value === "1" || this.value === 1;
        },

        watch: {
            boolValue() {
                this.$emit('input', this.boolValue);
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>

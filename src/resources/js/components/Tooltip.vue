<template>
    <div class="tooltip">
        <slot />
    </div>
</template>

<script>
    export default {
        name: 'tooltip',

        props: {
            light: {
                type: Boolean,
                default: false,
            }
        }
    }
</script>

<style lang="scss" scoped>
    .tooltip {
        padding: 1rem;
        background-color: black;
        border: 1px solid white;
    }
</style>

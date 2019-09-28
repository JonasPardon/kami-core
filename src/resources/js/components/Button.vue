<template>
    <div :class="buttonClass">
        <button @click="$emit('click')">
            <font-awesome-icon v-if="icon" :icon="icon" />
            <slot />
        </button>
    </div>
</template>

<script>
    export default {
        name: 'custom-btn',

        props: {
            small: {
                type: Boolean,
                default: false,
            },
            big: {
                type: Boolean,
                default: false,
            },
            confirm: {
                type: Boolean,
                default: false,
            },
            confirmText: {
                type: String,
                default: 'Are you sure you want to delete this item?',
            },
            classes: {
                type: String,
                default: '',
            },
            icon: {
                type: String,
                default: null,
            }
        },

        computed: {
            buttonClass() {
                return `btn ${this.classes}`;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .btn {
        button {
            padding: .8rem 1.1rem 1rem 1.1rem;
            display: block;
            line-height: 1.6rem;
            font-size: 1.3rem;
            font-weight: 600;
            color: white;
            background-color: rgb(74,139,252);
            box-shadow: 0 1px 3px rgba(0,0,0,.1);
            border-radius: .8rem;
            outline: none;
            transition: .2s all ease;

            svg {
                margin-right: .5rem;
            }

            &:hover {
                background-color: rgba(74,139,252,.9);
                box-shadow: 0 3px 5px rgba(0,0,0,.15);
            }

            &:active {
                outline: none;
            }
        }

        &.danger {
            button {
                background-color: rgb(231, 76, 60);

                &:hover {
                    background-color: rgba(231, 76, 60, .9);
                }
            }
        }
    }
</style>

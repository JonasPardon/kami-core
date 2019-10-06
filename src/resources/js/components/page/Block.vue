<template>
    <div class="block">
        <div class="block__title">{{ block.label }}</div>

        <div class="block__body">
            <div class="block__actions">
                <div class="block__actions__action block__actions__action--up">
                    <font-awesome-icon icon="chevron-up" @click="updateOrder(block, -1)"/>
                </div>
                <div class="block__actions__action block__actions__action--down">
                    <font-awesome-icon icon="chevron-down" @click="updateOrder(block, 1)"/>
                </div>
                <div class="block__actions__action block__actions__action--delete">
                    <font-awesome-icon icon="trash-alt" @click="deleteBlock(block)"/>
                </div>
            </div>
            <div class="block__body__content">
                <template v-if="block.type === 'textarea'">
                    <markdown v-model="block.content" />
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    import VueSimplemde from 'vue-simplemde';

    export default {
        name: 'page-block',

        props: ['value'],

        components: {
            'markdown': VueSimplemde,
        },

        data() {
            return {
                block: {},
            }
        },

        mounted() {
            this.block = this.value;
        },

        methods: {
            updateOrder(block, value) {
                block.order += value;
            },

            deleteBlock(block) {
                this.$emit('deleteItem', block);
            },
        },

        watch: {
            value() {
                this.$emit('input', this.block);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .block {
        box-shadow: 0 3px 5px rgba(0,0,0,.05);
        border-radius: .5rem;
        border: 1px solid #c3c5c8;
        margin-bottom: 4rem;
        transition: box-shadow .2s ease;

        &:hover {
            box-shadow: 0 3px 5px rgba(0,0,0,.15);
        }

        &__title {
            font-weight: 600;
            font-size: 1.5rem;
            padding: 2rem;
            border-bottom: 1px solid #c3c5c8;
        }

        &__actions {
            flex: 0 0 5rem;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #c3c5c8;
            margin-right: 1rem;

            &__action {
                width: 100%;
                height: 4rem;
                border-bottom: 1px solid #c3c5c8;
                padding: 1rem;
                cursor: pointer;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: white;
                transition: all .2s ease;

                svg {
                    transition: all .2s ease;
                }

                &:hover {
                    background-color: #394049;

                    svg {
                        color: white;
                        transform: scale(1.1);
                    }
                }

                &--delete {
                    &:hover {
                        background-color: #e74c3c;
                    }
                }
            }
        }

        &__body {
            display: flex;

            &__content {
                flex: 1 1 100%;
                padding: 2rem;
            }
        }
    }
</style>

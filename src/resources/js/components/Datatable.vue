<template>
    <div class="data-table">
        <table>
            <tr>
                <td v-for="header in headers" :key="header.label">
                    {{ header.label }}
                </td>
                <td v-if="editable || deletable"></td>
            </tr>

            <tr v-for="row in data">
                <td v-for="header in headers">

                    <template v-if="header.type === 'string' || !header.type">
                        {{ row[header.key] }}
                    </template>

                    <template v-if="header.type === 'boolean'">
                        <span v-if="row[header.key]">
                            <span class="bubble bubble--green"></span>
                            Yes
                        </span>
                        <span v-if="!row[header.key]">
                            <span class="bubble bubble--red"></span>
                            No
                        </span>
                    </template>

                    <template v-if="header.type === 'date'">
                        {{ formatDate(row[header.key]) }}
                    </template>

                    <template v-if="header.type === 'image'">
                        <div class="media" @click="showPreview(row[header.key])">

                            <div class="media__hover">
                                <font-awesome-icon icon="eye" />
                            </div>

                            <font-awesome-icon v-if="row.mime_type && row.mime_type.includes('pdf')" class="preview-image" icon="file-pdf" />
                            <img v-else class="preview-image" :src="row[header.key]">
                        </div>
                    </template>
                </td>
                <td v-if="editable || deletable" class="data-table__actions">
                    <div class="outer">
                        <div class="inner">
                            <custom-btn v-if="editable" @click="editItem(row)">Edit</custom-btn>
                            <custom-btn v-if="deletable" @click="deleteItem(row)" classes="danger">Delete</custom-btn>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <div :class="{'preview-modal': true, 'active': itemToPreview !== null}">
            <img :src="itemToPreview">
            <font-awesome-icon icon="times-circle" class="close-preview" @click="closePreview" />
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        name: 'data-table',

        props: {
            headers: {
                type: Array,
                required: true,
            },
            data: {
                type: Array,
                required: true,
            },
            editable: {
                type: Boolean,
                default: false,
            },
            deletable: {
                type: Boolean,
                default: false,
            }
        },

        data() {
            return {
                itemToPreview: null,
            }
        },

        methods: {
            formatDate(date) {
                const newDate = moment(date);
                return newDate.format('DD-MM-YYYY hh:mm:ss');
            },

            editItem(item) {
                this.$emit('editItem', item);
            },

            deleteItem(item) {
                this.$emit('deleteItem', item);
            },

            showPreview(item) {
                this.itemToPreview = item;
            },

            closePreview() {
                this.itemToPreview = null;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .data-table {
        width: 100%;
        overflow-x: scroll;

        table {
            width: 100%;

            tr { // BODY
                border-bottom: 1px solid #f3f5f9;
                width: 100%;
                position: relative;

                .data-table__actions {
                    padding: 0;
                    margin: 0;

                    .outer {
                        position: relative;

                        .inner {
                            position: absolute;
                            display: flex;
                            align-items: center;
                            right: 3rem;
                            top: -3rem;
                            opacity: 0;
                            padding-top: .8rem!important;
                            padding-bottom: 0!important;
                            /*padding-left: 4rem;*/
                            background-image: linear-gradient(rgba(0,0,0,0) 0%, rgba(255,255,255,1) 15%, rgba(255,255,255,1) 100%);
                            transition: all .2s ease;
                        }
                    }

                }

                &:hover {
                    .data-table__actions {
                        .outer .inner {
                            opacity: 1;
                            right: 1rem;
                        }
                    }
                }

                td {
                    padding: 2rem 1rem;
                    white-space: nowrap;
                }
            }

            tr:first-child { // HEADER
                td {
                    font-weight: 700;
                    text-transform: uppercase;
                }
            }
        }
    }

    .bubble {
        display: inline-block;
        width: 1.2rem;
        height: 1.2rem;
        border-radius: .6rem;
        margin-right: 1rem;
        box-shadow: 0 3px 5px rgba(0,0,0,.1);

        &--green {
            background-color: #27ae60;
        }

        &--red {
            background-color: #e74c3c;
        }
    }

    .media {
        position: relative;
        transition: all .2s ease;

        .preview-image {
            height: 6rem;
            width: 6rem;
            object-fit: cover;
            border-radius: 1rem;
        }

        &__hover {
            background-color: rgba(54, 57, 63, .5);
            width: 100%;
            height: 100%;
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            transition: all .2s ease;
            border-radius: 1rem;

            svg {
                width: 2rem;
                height: 2rem;
            }
        }

        &:hover {
            transform: scale(1.2);
            cursor: pointer;

            .media__hover {
                opacity: 1;
            }
        }
    }

    .preview-modal {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        padding: 5rem;
        opacity: 0;
        z-index: -1;
        transform: scale(1.1);
        background-color: rgba(110, 118, 136, .8);
        transition: all .2s ease;

        &.active {
            transform: scale(1);
            opacity: 1;
            z-index: 999;
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .close-preview {
            position: absolute;
            top: 2rem;
            right: 2rem;
            color: white;
            width: 3rem;
            height: 3rem;
            border-radius: 3rem;
            box-shadow: 0 1px 3px rgba(0,0,0,.1);
            transition: all .2s ease;

            &:hover {
                cursor: pointer;
                box-shadow: 0 1px 3px rgba(0,0,0,.2);
                transform: scale(1.3);
            }
        }
    }

</style>

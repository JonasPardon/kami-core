<template>
    <layout>
        <template v-if="noContent">
            <h1 class="title">
                Dashboard
            </h1>

            <div class="no-content">
                <h2 class="no-content__text">
                    There's nothing to be found here
                </h2>
                <img class="no-content__image" src="/img/svg/undraw_searching.svg" alt="No content">
            </div>
        </template>

        <template v-else>
            <h1 class="title">
                Dashboard
            </h1>
        </template>
    </layout>
</template>

<script>
    export default {
        name: 'home',

        data() {
            return {
                noContent: true,
            }
        },
    }
</script>

<style lang="scss" scoped>
    .no-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        &__text {
            text-align: center;
            width: 100%;
            font-size: 1.3rem;
            margin-bottom: 5rem;
        }

        &__image {
            width: 50%;
        }
    }
</style>

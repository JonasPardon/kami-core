<template>
    <div class="mini-sidebar">

        <div class="mini-sidebar__modules">
            <div class="mini-sidebar__module active">
                <font-awesome-icon icon="home" />
            </div>

            <div class="mini-sidebar__module">
                <font-awesome-icon icon="shopping-cart" />
            </div>

            <div class="mini-sidebar__module">
                <font-awesome-icon icon="mail-bulk" />
            </div>

            <div class="mini-sidebar__module">
                <font-awesome-icon icon="cogs" />
            </div>
        </div>

        <div class="mini-sidebar__bottom">
            <div class="mini-sidebar__profile" @click="logout">
                <font-awesome-icon icon="user-alt" />
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'mini-sidebar',

        methods: {
            logout() {
                window.location = '/admin/logout';
            }
        }
    }
</script>

<style lang="scss" scoped>
    .mini-sidebar {
        background-color: rgb(57, 64, 73);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        max-height: 100vh;
        overflow-y: scroll;

        &__modules, &__bottom {
            width: 100%;
        }

        &__module, &__profile {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #F2F4F8;
            height: 7rem;
            width: 100%;
            /*margin: 1rem 0;*/
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
            position: relative;
            transition: all .2s ease;

            svg {
                min-height: 2rem;
                min-width: 2rem;
                transition: all .2s ease;
            }

            &:hover, &.active {
                cursor: pointer;
                background-color: rgb(122, 142, 152);
                /*border-top-left-radius: 2rem;*/
                /*border-bottom-left-radius: 2rem;*/
                box-shadow: 0 3px 5px rgba(0,0,0,.15);

                svg {
                    transform: scale(1.2);
                }
            }

            &.active {
                background-color: rgb(242, 244, 248);
                color: rgb(57, 64, 73);
            }
        }
    }

    .placeholder {
        background-color: lightgrey;
        width: 4rem;
        height: 4rem;
        margin: 2rem 1rem;
        border-radius: 3rem;
    }
</style>

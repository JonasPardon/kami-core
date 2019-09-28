<template>
    <main class="page">
        <mini-sidebar class="mini-sidebar-wrapper" />

        <sidebar class="sidebar-wrapper" />

        <article class="page-content">
            <slot />
        </article>
    </main>
</template>

<script>
    import MiniSidebar from "./MiniSidebar";
    import Sidebar from './Sidebar';

    export default {
        name: 'layout',

        components: {
            'sidebar': Sidebar,
            'mini-sidebar': MiniSidebar,
        },

        data() {
            return {
                navLinks: [
                    {url: '/admin', label: 'Home'},
                    {url: '/admin/pages', label: 'Pages'},
                ],
            }
        },
    }
</script>

<style lang="scss" scoped>
    .page {
        display: flex;
        min-height: 100vh;

        .mini-sidebar-wrapper {
            flex: 0 0 7rem;
        }

        .sidebar-wrapper {
            flex: 0 0 26.5rem;
        }

        .page-content {
            flex: 1 1 80%;
            padding: 2rem;
            position: relative;
            height: 100vh;
            overflow-y: scroll;
            box-shadow: 0 3px 5px rgba(0,0,0,.15);
        }
    }
</style>

<style lang="scss">
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap');
    @import '~simplemde/dist/simplemde.min.css';

    html {
        font-size: 62.5%;
        scroll-behavior: smooth;
    }

    body {
        font-size: 1.2rem;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        background-color: white;
        font-family: 'Open Sans', sans-serif;
        color: #36393f;
    }

    .title {
        font-size: 2.1rem;
        font-weight: 700;
        margin-bottom: 3rem;
    }

    .subtitle {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        font-weight: unset;
    }

    .page-actions {
        position: absolute;
        right: 1rem;
        top: 2rem;
        display: flex;
        justify-content: space-between;

        .btn-page-action {
            /*margin-left: 1rem;*/
        }
    }

    .toast {
        color: white!important;
        padding: 2rem!important;
        border-radius: 1rem!important;
        box-shadow: 0 3px 5px rgba(0,0,0,.1)!important;
        font-family: 'Open Sans', sans-serif!important;
        font-weight: 600!important;
        font-size: 1.3rem!important;

        &--success {
            background-color: rgb(46, 204, 113) !important;
        }

        &--error {
            background-color: rgb(231, 76, 60)!important;
        }
    }

    input[type=text], input[type=password] {
        padding: .5rem;
        border: .5px solid rgba(57, 64, 73, .3);
        border-radius: .5rem;
        outline: none;
        width: 100%;
        max-width: 30rem;
        box-shadow: 0 3px 5px rgba(0,0,0,.05);
        transition: all .2s ease;

        &:focus {
            border: .5px solid rgba(57, 64, 73, .5);
            box-shadow: 0 3px 5px rgba(0,0,0,.1);
        }
    }
</style>

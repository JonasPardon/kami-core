<template>
    <div class="sidebar">
        <div class="sidebar__logo">
            <h2>Your website</h2>
        </div>
        <ul>
            <li v-for="link in navLinks" :key="link.url">
                <inertia-link :href="link.url" :class="{ active: isActive(link) }">
                    <font-awesome-icon :icon="link.icon" /> {{ link.label }}
                </inertia-link>
            </li>
        </ul>
    </div>
</template>

<script>
    import routes from './../routes';

    export default {
        name: 'sidebar',

        data() {
            return {
                navLinks: routes,
            }
        },

        methods: {
            isActive(link) {
                const current = window.location.pathname.replace('/admin', '');
                const compare = link.url.replace('/admin', '');
                if (current === '/' && compare === '/') {
                    return true;
                } else if (compare !== '/') {
                    return current.includes(compare);
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .sidebar {
        background-color: rgb(242, 244, 248);
        color: rgb(110, 118, 136);
        max-height: 100vh;
        overflow-y: scroll;

        &__logo {
            margin: 2rem;

            h2 {
                font-weight: 600;
                font-size: 1.6rem;
            }
        }

        ul {
            padding-left: 0;

            li {
                list-style-type: none;

                a {
                    color: #6e7688;
                    display: block;
                    padding: 1rem 3rem 1rem 2rem;
                    font-size: 1.3rem;
                    position: relative;
                    text-decoration: none;

                    &:after {
                        content: '';
                        position: absolute;
                        height: 80%;
                        width: 4px;
                        right: 6px;
                        top: 10%;
                        background-color: rgb(74,139,252);
                        box-shadow: 0 1px 3px rgba(0,0,0,.1);
                        opacity: 0;
                        transition: .2s all ease;
                    }

                    &:hover, &.active {
                        text-decoration: none;
                        font-weight: 600;
                        color: rgb(74,139,252);

                        &:after {
                            right: 0;
                            opacity: 1;
                        }
                    }

                    svg {
                        margin-right: 1rem;
                    }
                }
            }
        }

    }
</style>

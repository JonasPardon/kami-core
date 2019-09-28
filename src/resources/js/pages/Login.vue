<template>
    <div class="login">
        <div class="login__modal">
            <div class="login__modal__row">
                <label for="email">E-mail</label>
                <input type="text" v-model="email" id="email" name="email">
            </div>

            <div class="login__modal__row">
                <label for="password">Password</label>
                <input type="password" v-model="password" id="password" name="password">
            </div>

            <div class="login__modal__row">
                <custom-btn icon="chevron-right" @click="submitLogin">Login</custom-btn>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'login',

        data() {
            return {
                email: null,
                password: null,
            }
        },

        methods: {
            submitLogin() {
                axios.post('/admin/login', {
                    email: this.email,
                    password: this.password,
                }).then(response => {
                    if (response.data.email === this.email) {
                        this.$inertia.visit('/admin/');
                    }
                }).catch(err => {
                    // this.$inertia.visit('/admin/');
                });
            }
        }
    }
</script>

<style lang="scss" scoped>
    .login {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100vw;
        background-image: url('/img/background.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

        &__modal {
            min-height: 20rem;
            min-width: 30rem;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 3px 5px rgba(0,0,0,.15);
            background: white;

            &__row {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: flex-start;
                margin-bottom: 2rem;

                &:last-child {
                    margin-bottom: 0;
                }
            }
        }
    }
</style>

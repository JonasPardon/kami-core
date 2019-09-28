const duration = 5000;

export default {
    methods: {
        successToast(message) {
            this.$toasted.show(message, {
                duration,
                className: 'toast toast--success',
                iconPack: 'fontawesome',
                icon: 'check',
                type: 'success',
                singleton: true,
            });
        },

        errorToast(message) {
            this.$toasted.show(message, {
                duration,
                className: 'toast toast--error',
                iconPack: 'fontawesome',
                icon: 'times',
                type: 'error',
                singleton: true,
            });
        }
    }
}

const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/wire-elements/modal/resources/views/*.blade.php',
        './storage/framework/views/*.php',
    ],
    safelist: [
        'sm:max-w-2xl'
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                danger: colors.red,
                info: colors.blue,
                primary: colors.amber,
                secondary: colors.gray,
                success: colors.green,
                warning: colors.amber,
                tirma: '#3A438D',
                tirmaYellow: '#EFE7BB',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}

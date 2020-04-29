module.exports = {
    theme: {
        extend: {
            width: {
                '96': '24rem',
                '112': '28rem',
                '128': '32rem',
                '144': '36rem',
                '160': '40rem',
            }
        }
    },
    variants: {
        padding: ['responsive', 'first', 'hover', 'focus', 'last'],
        cursor: ['hover'],
        outline: ['focus'],
        opacity: ['hover', 'group-hover'],
        background: ['hover', 'group-hover'],
        border: ['focus', 'hover'],
        textColor: ['hover', 'focus', 'group-hover'],
    },
    plugins: []
};

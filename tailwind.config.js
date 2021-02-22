module.exports = {
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        backgroundColor: {
            page: 'var(--page-background-color)',
            card: 'var(--card-background-color)',
            button: 'var(--button-background-color)',
            header: 'var(--header-background-color)'
        },
        colors: {
            default: 'var(--text-default-color)',
            border: 'var(--border-color)',
            'border-focus': 'var(--border-color-focus)',
            accent: 'var(--text-accent-color)',
            'accent-light': 'var(--text-accent-light-color)',
            muted: 'var(--text-muted-color)',
            'muted-light': 'var(--text-muted-light-color)',
            grey: {
                light: '#F5F6F9',
                font: 'rgba(0,0,0,0.4)',
            },
            blue: {
                primary: '#47cdff',
                light: '#8ae2fe'
            }
        },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}

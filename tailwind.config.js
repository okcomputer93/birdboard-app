module.exports = {
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        colors: {
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

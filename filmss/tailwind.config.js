/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors:{
            'green': '#012b29',
            'yellow': '#ecb42d',
            'green2': '#1f4442',
            'blanco': '#fff',
        },
        fontFamily: {
            'sans': ['MiFuente', 'sans-serif'],
        },
    },
  },
  plugins: [],
}


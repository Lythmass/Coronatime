/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      boxShadow: {
        'smooth': '0 0 0 4.5px hsl(237, 90%, 54%, 0.075)',
        'shadow-border': '0 2.65rem 0 hsl(0, 100%, 0%)'
      },
      colors: {
        lightBlue: 'hsl(237, 90%, 54%, 0.1)',
        lightGreen: 'hsl(124, 63%, 38%, 0.1)',
        lightYellow: 'hsl(54, 83%, 52%, 0.1)'
      },
      screens: {
        maxLg: {'max': '1024px'}
      }
    },
  },
  plugins: [],
}

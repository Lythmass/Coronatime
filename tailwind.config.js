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
        'smooth': '0 0 0 4.5px hsl(237, 90%, 54%, 0.075)'
      }
    },
  },
  plugins: [],
}

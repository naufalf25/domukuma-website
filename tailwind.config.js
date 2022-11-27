/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./dist/**/*.php"
  ],
  theme: {
    extend: {
      fontFamily: {
        "primary": "'Nunito', sans-serif",
      },
      colors: {
        "ukm": "#08A9F3"
      }
    },
  },
  plugins: [],
}

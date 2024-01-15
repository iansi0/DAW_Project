/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/Views/**/*.php"],
  theme: {
    extend: {
      colors:{
        'primario': '#B23000',
        'segundario': '#F2F2F2',
        'terciario-1': '#333333',
        'terciario-2': '#B3B3B3',
        'terciario-3': '#888888',
        'terciario-4': '#575555',
      },

      fontFamily:{
        'sans': ['Glacial Indifference'],
      },
    },
  },
  plugins: [],
}


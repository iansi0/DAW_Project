/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",
    "./app/Controllers/**/*.php"
  ],
  theme: {
    extend: {
      colors:{
        // 'primario': '#B23000',
        'primario': '#b92640',
        'secundario': '#F2F2F2',
        'terciario-1': '#333333',
        'terciario-2': '#B3B3B3',
        'terciario-3': '#888888',
        'terciario-4': '#575555',
        'light-blue': '#add8e6',
        'succes': '#4caf50',
       

      },

      fontFamily:{
        'sans': ['Glacial Indifference'],
      },
    },
  },
  plugins: [],
}


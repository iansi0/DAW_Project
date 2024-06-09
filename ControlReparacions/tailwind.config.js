/** @type {import('tailwindcss').Config} */
  // const theme = window.tema;
  // console.log(theme);
  // if ((theme!="light")) {
  module.exports = {
    content: [
      "./app/Views/**/*.php",
      "./app/Controllers/**/*.php"
    ],
    theme: {
      extend: {
        gridTemplateColumns: {
          // Definir las clases de columnas personalizadas
          '1': 'repeat(1, minmax(0, 1fr))',
          '2': 'repeat(2, minmax(0, 1fr))',
          '3': 'repeat(3, minmax(0, 1fr))',
          '4': 'repeat(4, minmax(0, 1fr))',
          '5': 'repeat(5, minmax(0, 1fr))',
          '6': 'repeat(6, minmax(0, 1fr))',
          '7': 'repeat(7, minmax(0, 1fr))',
          '8': 'repeat(8, minmax(0, 1fr))',
          '9': 'repeat(9, minmax(0, 1fr))',
          '10': 'repeat(10, minmax(0, 1fr))',
          '11': 'repeat(11, minmax(0, 1fr))',
          '12': 'repeat(12, minmax(0, 1fr))',
          'auto': 'auto', 

          // CUSTOM
          '2-large-1-small': '40% 55% 5%',
        },
        gridColumn: {
          'span-1': 'span 1 / span 1',
          'span-2': 'span 2 / span 2',
          'span-3': 'span 3 / span 3',
          'span-4': 'span 4 / span 4',
          'span-5': 'span 5 / span 5',
          'span-6': 'span 6 / span 6',
          'span-7': 'span 7 / span 7',
          'span-8': 'span 8 / span 8',
          'span-9': 'span 9 / span 9',
          'span-10': 'span 10 / span 10',
          'span-11': 'span 11 / span 11',
          'span-12': 'span 12 / span 12',
          'auto': 'auto',
        },
        colors: {
          // 'primario': '#B23000',
          // 'primario': '#b92640',
          'primario': '#003049',
          'secundario': '#F2F2F2',
          'terciario-1': '#333333',
          'terciario-2': '#B3B3B3',
          'terciario-3': '#888888',
          'terciario-4': '#575555',
          'light-blue': '#ADD8E6',
          'succes': '#4CAF50',
          'estat_1_hover': '#212121',
          'estat_2_hover': '#4caf50',
          'estat_3_hover': '#4caf50',
          'estat_4_hover': '#4caf50',
          'estat_5_hover': '#4caf50',
          'estat_6_hover': '#4caf50',
          'estat_7_hover': '#4caf50',
          'estat_8_hover': '#4caf50',
          'estat_9_hover': '#4caf50',
          'estat_10_hover': '#4caf50',
          'estat_11_hover': '#4caf50',
          'estat_12_hover': '#4caf50',
          'estat_13_hover': '#4caf50',
          'estat_14_hover': '#4caf50',
        },
  
        fontFamily:{
          // 'sans': ['Glacial Indifference'],
        },
      },
    },
    plugins: [],
  }
  
// }else{
//   module.exports = {
//     content: [
//       "./app/Views/**/*.php",
//       "./app/Controllers/**/*.php"
//     ],
//     theme: {
//       extend: {
//         colors:{
//           // 'primario': '#B23000',
//           'primario': '#b92640',
//           // 'primario': '#111111',
//           'secundario': '#F2F2F2',
//           'terciario-1': '#333333',
//           'terciario-2': '#B3B3B3',
//           'terciario-3': '#888888',
//           'terciario-4': '#575555',
//           'light-blue': '#ADD8E6',
//           'succes': '#4CAF50',
//           'estat_1_hover': '#212121',
//           'estat_2_hover': '#4caf50',
//           'estat_3_hover': '#4caf50',
//           'estat_4_hover': '#4caf50',
//           'estat_5_hover': '#4caf50',
//           'estat_6_hover': '#4caf50',
//           'estat_7_hover': '#4caf50',
//           'estat_8_hover': '#4caf50',
//           'estat_9_hover': '#4caf50',
//           'estat_10_hover': '#4caf50',
//           'estat_11_hover': '#4caf50',
//           'estat_12_hover': '#4caf50',
//           'estat_13_hover': '#4caf50',
//           'estat_14_hover': '#4caf50',
         
          
//         },
  
//         fontFamily:{
//           // 'sans': ['Glacial Indifference'],
//         },
//       },
//     },
//     plugins: [],
//   }
// }


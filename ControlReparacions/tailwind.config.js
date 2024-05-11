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
        colors:{
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


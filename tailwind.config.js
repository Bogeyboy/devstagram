/** @type {import('tailwindcss').Config} */
export default {
  content: [/* vamos a indicar los archivos que van a usar tailwindcss que serán todos los archivos .blade.php dentro de "resources"*/
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}


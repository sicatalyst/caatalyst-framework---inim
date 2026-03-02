/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './**/*.php',
    './modules/**/*.php',
    './resources/**/*.{js,jsx,ts,tsx,vue}',
  ],
  theme: {
    extend: {
      colors: {
        'inim-blue': '#174274',
        'inim-blue-dark': '#0f2d4d',
        'inim-blue-light': '#88afff',
        'inim-red': '#ed1c24',
        'inim-black': '#231f20',
      },
      fontFamily: {
        'kumbh': ['"Kumbh Sans"', 'Helvetica', 'sans-serif'],
        'arial': ['Arial', 'Helvetica', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

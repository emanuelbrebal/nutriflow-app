/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.vue',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        sidebar: {
          DEFAULT: 'oklch(0.205 0 0)',           
          foreground: 'oklch(0.985 0 0)',         
          primary: 'oklch(0.488 0.243 264.376)',  
          'primary-foreground': 'oklch(0.985 0 0)',
          accent: 'oklch(0.269 0 0)',
          'accent-foreground': 'oklch(0.985 0 0)',
          border: 'oklch(0.269 0 0)',
          ring: 'oklch(0.439 0 0)',
        },
        chart: {
          4: 'oklch(0.627 0.265 303.9)',
          5: 'oklch(0.645 0.246 16.439)',
        },
      },
    },
  },
  plugins: [],
}

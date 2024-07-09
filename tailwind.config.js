module.exports = {
  // content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/**/*.{js,jsx,vue}",
  ],
  theme: {
    extend: {
      colors: {
        primary: { "50": "#fefce8", "100": "#fef9c3", "200": "#fef08a", "300": "#fde047", "400": "#facc15", "500": "#eab308", "600": "#ca8a04", "700": "#a16207", "800": "#854d0e", "900": "#713f12", "950": "#422006" }
      }
    },
  },
  plugins: [],
} 
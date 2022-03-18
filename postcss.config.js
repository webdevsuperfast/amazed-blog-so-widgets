module.exports = {
  plugins: [
    require("tailwindcss", {
      config: "./tailwind.config.js",
    }),
    require("autoprefixer"),
    require("postcss-nested"),
    require("postcss-import"),
    require("postcss-nested-ancestors"),
  ],
};

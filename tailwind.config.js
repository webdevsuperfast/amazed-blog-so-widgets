module.exports = {
  content: [
    "./widgets/amazed-blog-categories/*.{php,html}",
    "./widgets/amazed-blog-posts/*.{php,html}",
  ],
  corePlugins: {
    preFlight: false,
  },
  prefix: "absw-",
  theme: {
    extend: {},
  },
  plugins: [],
};

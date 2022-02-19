module.exports = {
  content: [
    "./widgets/amazed-blog-categories/**/*.{php,html}",
    "./widgets/amazed-blog-posts/**/*.{php,html}",
  ],
  prefix: "absw-",
  corePlugins: {
    preflight: false,
  },
  important: false,
  theme: {
    extend: {},
  },
  plugins: [],
};

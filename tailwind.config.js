module.exports = {
  content: [
    "./widgets/amazed-blog-categories/tpl/*.php",
    "./widgets/amazed-blog-posts/tpl/*.php",
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
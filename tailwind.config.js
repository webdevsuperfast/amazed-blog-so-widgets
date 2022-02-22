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
    extend: {
      gridTemplateColumns: {
        20: "repeat(20, minmax(0, 1fr))", // 55/45
      },
    },
  },
  plugins: [],
};

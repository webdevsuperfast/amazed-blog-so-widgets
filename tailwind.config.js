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
    screens: {
      sm: "576px",
      md: "768px",
      lg: "992px",
      xl: "1200px",
      "2xl": "1400px",
    },
    extend: {
      gridTemplateColumns: {
        20: "repeat(20, minmax(0, 1fr))", // 55/45
      },
    },
  },
  plugins: [],
};

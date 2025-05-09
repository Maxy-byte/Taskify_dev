import withMT from "@material-tailwind/html/utils/withMT";

module.exports = withMT ({
    content: [
      './templates/**/*.html.twig',
      './assets/**/*.js',
    ],
    theme: {
      extend: {},
    },
    plugins: [],
  });
  
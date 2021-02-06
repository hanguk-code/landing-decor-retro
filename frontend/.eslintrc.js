module.exports = {
  root: true,
  env: {
    browser: true,
    node: true
  },
  parserOptions: {
    parser: 'babel-eslint'
  },
  extends: [
    '@nuxtjs',
    'plugin:nuxt/recommended'
  ],
  // add your custom rules here
  rules: {
    "indent": [4, "tab"],
    "no-tabs": 0,
    "no-irregular-whitespace": 0,
    "vue/html-indent": ["error", "tab", {
      "attribute": 1,
      "baseIndent": 1,
      "closeBracket": 0,
      "alignAttributesVertically": false,
      "ignores": []
    }]
  }
}

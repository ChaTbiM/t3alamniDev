module.exports = {
    env: {
        browser: true,
        es6: true
    },
    extends: "plugin:vue/essential",
    globals: {
        Atomics: "readonly",
        SharedArrayBuffer: "readonly"
    },
    parserOptions: {
        ecmaVersion: 2018,
        sourceType: "module"
    },
    plugins: ["vue", "phpPlugin"],
    rules: {}
};

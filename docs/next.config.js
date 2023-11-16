const withNextra = require("nextra")({
    theme: "nextra-theme-docs",
    themeConfig: "./theme.config.jsx",
});

const isGithubActions = process.env.GITHUB_ACTIONS || false;

let basePath = "";

if (isGithubActions) {
    basePath = "/wordpressboilerplatedocs";
}

module.exports = withNextra({
    output: "export",
    basePath: basePath,
    images: {
        unoptimized: true,
    },
});

export default {
    logo: <span>ACF Builder</span>,
    project: {
        link: "https://github.com/JorenRothman/ACF-Builder",
    },
    docsRepositoryBase:
        "https://github.com/JorenRothman/ACF-Builder/tree/main/docs",
    navigation: {
        prev: true,
        next: true,
    },
    footer: {
        text: <span>MIT {new Date().getFullYear()} © ACF Builder.</span>,
    },
    useNextSeoProps() {
        return {
            titleTemplate: "%s - ACF Builder",
        };
    },
};

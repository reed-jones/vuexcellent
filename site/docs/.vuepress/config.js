module.exports = {
    title: 'Vuexcellent',
    description: 'Magic Data Loading. Laravel <-> Vuex Syncing',
    themeConfig: {
        repo: 'reed-jones/vuexcellent',
        docsDir: 'docs',
        editLinks: true,
        nav: [
            { text: 'Home', link: '/' },
        ],
        sidebar: [
            {
                title: 'Getting Started',
                collapsable: false,
                children: [
                    '/',
                    '/installation/',
                    '/usage',
                    '/api/'
                ]
            }
        ]
    }
}

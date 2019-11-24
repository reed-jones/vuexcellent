module.exports = {
    title: 'Vuexcellent',
    description: 'Just playing around',
    themeConfig: {
        repo: 'reed-jones/vuexcellent-docs',
        docsDir: 'docs',
        editLinks: true,
        nav: [
            { text: 'Home', link: '/' },
            { text: 'Vuexcellent-Laravel', link: 'https://github.com/reed-jones/vuexcellent-laravel' },
            { text: 'Vuexcellent-Vue', link: 'https://github.com/reed-jones/vuexcellent-js' },
        ],
        sidebar: [
            {
                title: 'Getting Started',
                collapsable: false,
                children: [
                    '/',
                    '/installation/laravel',
                    '/installation/vue',
                    '/usage',
                    '/api-reference'
                ]
            }
        ]
    }
}

module.exports = {
    apps: [
        {
            name: 'decor',
            host: process.env.APP_URL,
            script: 'npm run start',
            env: {
                NODE_ENV: 'development'
            },
            env_production: {
                NODE_ENV: 'production'
            }
        },
        {
            name: 'laravel',
            host: process.env.CLIENT_URL,
            script: 'php artisan serve --host=193.169.179.233 --port=8000',
            env: {
                NODE_ENV: 'development'
            },
            env_production: {
                NODE_ENV: 'production'
            }
        },
        // {
        //     name: 'decor-admin',
        //     port: 3001,
        //     script: './node_modules/nuxt/bin/nuxt-start',
        //     // cwd: '/home/user/your-nuxt-project/app2',
        //     env: {
        //         NODE_ENV: 'development'
        //     },
        //     env_production: {
        //         NODE_ENV: 'production'
        //     }
        // }
    ]
};

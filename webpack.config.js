const path = require('path');
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );

module.exports = {
    entry: {'./assets/build/js/editor.js': './assets/src/js/editor.js'},
    output: {
        path: path.resolve(__dirname, ''),
        filename: '[name]',
    },
    mode: 'development',
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            ['@babel/preset-env', { targets: '> 0.1%' }],
                            '@babel/preset-react'
                        ]
                    }
                }
            }
        ]
    },
    plugins: [
        new DependencyExtractionWebpackPlugin({
            outputFormat: 'json',
            injectPolyfill: false
        })
    ],
};
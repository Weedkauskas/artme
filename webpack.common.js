const path = require('path');

module.exports = {
    entry: {
        app: './resources/js/app.ts',
    },
    output: {
        filename: './public/js/[name].js',
        library: "[name]",
        libraryTarget: 'umd',
        path: path.resolve(__dirname)
    },
    resolve: {
        extensions: ['.tsx', '.ts', '.js'],
    },
    mode: 'production',
    optimization: {
        usedExports: true,
    },
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                use: 'ts-loader',
                exclude: /node_modules/,
            }
        ]
    },
    performance: {
        hints: false
    }
};

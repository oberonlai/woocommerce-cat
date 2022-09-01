const pkg = require('./package.json');

module.exports = {
	// Project Identity
	appName: 'wooocommerceCat', // Unique name of your project
	type: 'plugin', // Plugin or theme
	slug: 'woocommerce-cat', // Plugin or Theme slug, basically the directory name under `wp-content/<themes|plugins>`
	// Used to generate banners on top of compiled stuff
	bannerConfig: {
		name: 'wooocommerceCat',
		author: '',
		license: 'UNLICENSED',
		link: 'UNLICENSED',
		version: pkg.version,
		copyrightText:
			'This software is released under the UNLICENSED License\nhttps://opensource.org/licenses/UNLICENSED',
		credit: true,
	},
	// Files we need to compile, and where to put
	files: [
		// If this has length === 1, then single compiler
		 {
		 	name: 'app',
		 	entry: {
		 		// mention each non-interdependent files as entry points
		      // The keys of the object will be used to generate filenames
		      // The values can be string or Array of strings (string|string[])
		      // But unlike webpack itself, it can not be anything else
		      // <https://webpack.js.org/concepts/#entry>
		      // You do not need to worry about file-size, because we would do
		      // code splitting automatically. When using ES6 modules, forget
		      // global namespace pollutions 😉
		 		main: './assets/src/main.js', // Could be a string
		 		//main: ['./src/mobile/index.js'], // Or an array of string (string[])
		 	},
		 // If enabled, all WordPress provided external scripts, including React
		 // and ReactDOM are aliased automatically. Do note that all `@wordpress`
		 // namespaced imports are automatically aliased and enqueued by the
		 // PHP library. It will not change the JSX pragma because of external
		 // dependencies.
		 optimizeForGutenberg: false,
		 	// Extra webpack config to be passed directly
		 	webpackConfig: undefined,
		 },
		// If has more length, then multi-compiler
	],
	// Output path relative to the context directory
	// We need relative path here, else, we can not map to publicPath
	outputPath: 'assets/dist',
	// Project specific config
	// Needs react(jsx)?
	hasReact: false,
	// Whether or not to use the new jsx runtime introduced in React 17
	// this is opt-in
	// @see {https://reactjs.org/blog/2020/09/22/introducing-the-new-jsx-transform.html}
	useReactJsxRuntime: false,
	// Disable react refresh
	disableReactRefresh: false,
	// Needs sass?
	hasSass: true,
	// Needs less?
	hasLess: false,
	// Needs flowtype?
	hasFlow: false,
	// Externals
	// <https://webpack.js.org/configuration/externals/>
	externals: {
		jquery: 'jQuery',
	},
	// Webpack Aliases
	// <https://webpack.js.org/configuration/resolve/#resolve-alias>
	alias: undefined,
	// Show overlay on development
	errorOverlay: true,
	// Auto optimization by webpack
	// Split all common chunks with default config
	// <https://webpack.js.org/plugins/split-chunks-plugin/#optimization-splitchunks>
	// Won't hurt because we use PHP to automate loading
	optimizeSplitChunks: true,
	// Usually PHP and other files to watch and reload when changed
	watch: ['./src/**/*.php','./assets/src/*.js','./assets/src/*.scss','*.php'],
	// Files that you want to copy to your ultimate theme/plugin package
	// Supports glob matching from minimatch
	// @link <https://github.com/isaacs/minimatch#usage>
	packageFiles: [
		'inc/**',
		'vendor/**',
		'dist/**',
		'*.php',
		'*.md',
		'readme.txt',
		'languages/**',
		'layouts/**',
		'LICENSE',
		'*.css',
	],
	// Path to package directory, relative to the root
	packageDirPath: 'package',
	// whether or not to disable wordpress external scripts handling
	disableWordPressExternals: false,
};

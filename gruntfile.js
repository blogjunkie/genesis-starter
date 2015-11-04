module.exports = function(grunt) {
	
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
		/* configure plugins */
		
		// Concatenate multiple scripts into scripts.js
		concat: {
			build: {
				src: [
					'bower_components/jquery.fitvids/jquery.fitvids.js'
				],
				dest: 'lib/js/scripts.js',
				nonull: true
			},				
		},
		
		// dev task is expanded with sourcemap
		// build task is compressed with no sourcemap
		sass: {
			dev: {
				options: {
					outputStyle: 'expanded',
					indentType: 'tab',
					indentWidth: 1,
					sourceMap: true
				},
				files: {
					'style.css': 'sass/style.scss'
				}
			},
			build: {
				options: {
					outputStyle: 'compressed',
				},
				files: {
					'style.css': 'sass/style.scss'
				}
			}
		},
		
		// Minifies JS
		uglify: {
			options: {
				preserveComments: 'some',
			},
			build: {
				files: {
					'lib/js/init.min.js': 'lib/js/init.js'
				}
			}
		},
		
		// Run default Grunt task when there are changes to JS and CSS
		watch: {
			js: {
				files: ['lib/js/**/*.js'],
				tasks: ['uglify'],
				options: {
					spawn: false
				}
			},

			css: {
				files: ['sass/**/*.scss'],
				tasks: ['sass:dev'],
				options: {
					spawn: false
				}
			}
		}
		
	});

	/* plugins to load */
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-sass');
	
	/* tasks to run */
	grunt.registerTask('default', ['concat','sass:dev','uglify']);
	grunt.registerTask('build', ['concat','sass:build']);

};
/*global module:false, require:false */
/**!
 * Gruntfile
 * Follow README.md to get started
 */
module.exports = function(grunt) {
    "use strict";

    /**
     * Load all grunt tasks.
     */
    require('load-grunt-tasks')(grunt);

    /**
     * Displays the elapsed execution time of grunt tasks
     */
    require('time-grunt')(grunt);

    /**
     * Project configuration
     */
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        publicPath: '.',
        cssPath: 'themes/otp/less',
        jsPath: 'themes/otp/js',
        assetPath: 'themes/otp/static',
        banner: '/*!\n * <%= pkg.description %> - <%= pkg.author %> - Build <%= pkg.version %> \n */\n',


        //  -------------------------------------------------------- //
        //  CSS & LESS
        //  -------------------------------------------------------- //

        less: {
            style: {
                files: [
                    {src: ['<%= cssPath %>/otp.less'], dest: '<%= assetPath %>/otp.css'},
                ]
            }
        },

        //  -------------------------------------------------------- //
        //  Rem Fallback
        //  -------------------------------------------------------- //
        rem_to_px: {
            options: {
                baseFontSize: 16,
                removeFontFace: false
            },
            dist: {
                src: ['<%= assetPath %>/otp.css'],
                dest: '<%= assetPath %>/ie'
            }
        },


        /*
        remfallback: {
            options: {
                log: false,
                replace: true,
                round: true
            },
            target: {
                files: {
                    '<%= assetPath %>/ie.css': ['<%= assetPath %>/otp.css']
                }
            }
        },*/

        cssmin: {
            options: {
                banner: '<%= banner %>'
            },
            style: {
                files: [
                    {src: ['<%= assetPath %>/otp.css'], dest: '<%= assetPath %>/otp.min.css'},
                    {src: ['<%= assetPath %>/ie/otp.css'], dest: '<%= assetPath %>/ie/otp.min.css'},
                ],
            }
        },


        //  -------------------------------------------------------- //
        //  Build - Concatenate and minify files
        //  -------------------------------------------------------- //
        jshint: {
            files: [
                'Gruntfile.js',
                '<%= jsPath %>/app/components/*.js',
                '<%= assetPath %>/js/app.js'
            ],
            options: {
                jshintrc: '.jshintrc'
            }
        },

        concat: {
            options: {
                separator: ';',
                banner: '<%= banner %>'
            },
            thirdparty: {
                src: [
                    '<%= jsPath %>/thirdparty/jquery.js',
                    '<%= jsPath %>/thirdparty/fancybox/lib/jquery.mousewheel-3.0.6.pack.js',
                    '<%= jsPath %>/thirdparty/imagesloaded.js',
                    '<%= jsPath %>/thirdparty/masonry/packery.js',
                    '<%= jsPath %>/thirdparty/masonry/isotope.pkgd.min.js',
                    '<%= jsPath %>/thirdparty/chosen/chosen.jquery.min.js',
                    '<%= jsPath %>/thirdparty/flexslider/jquery.flexslider-min.js',
                    '<%= jsPath %>/thirdparty/fancybox/source/jquery.fancybox.js',
                    '<%= jsPath %>/thirdparty/fancybox/source/helpers/jquery.fancybox-media.js',
                    '<%= jsPath %>/thirdparty/cookie/jquery.cookie.js',
					'<%= jsPath %>/thirdparty/jquery.ui.touch-punch.min.js',
                    '<%= jsPath %>/thirdparty/picturefill.min.js'
                ],
                dest: '<%= assetPath %>/thirdparty.js'
            },
            app: {
                src: [
                    '<%= jsPath %>/app/components/**/*.js',
                    '<%= jsPath %>/app/app.js'
                ],
                dest: '<%= assetPath %>/app.js'
            },
            dist: {
                src: [
                    '<%= assetPath %>/thirdparty.js',
                    '<%= assetPath %>/app.js'
                ],
                dest: '<%= assetPath %>/combined.js'
            }
        },

        uglify: {
            options: {
                banner: '<%= banner %>'
            },
            dist: {
                files: {
                    '<%= assetPath %>/combined.min.js': [ '<%= assetPath %>/combined.js' ]
                }
            }
        },


        //  -------------------------------------------------------- //
        //  Watch
        //  -------------------------------------------------------- //

        watch: {
            lint: {
                files: [
                    '<%= jsPath %>/**/*.js',
                ],
                tasks: [ 'build:js' ]
            },
            less: {
                files: [ '<%= cssPath %>/*.less' ],
                tasks: [ 'build:css' ]
            }
        }




    });


    /**
     * Register tasks
     */
    grunt.registerTask('build:css', [
        'less',
        'rem_to_px',
        'cssmin',
    ]);

    grunt.registerTask('build:js', [
        'jshint',
        'concat'
       // 'uglify'
    ]);

    grunt.registerTask('build', [
        'build:css',
        'build:js'
    ]);

    grunt.registerTask('default', [
        'build'
    ]);

    grunt.registerTask('production', [
        'uglify'
    ]);
};

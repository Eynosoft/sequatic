!(function () {
    'use strict';
    module.exports = function (grunt) {
        var cssFiles = [
            'public/css/main.css'
        ];
        grunt.initConfig({
            pkg: grunt.file.readJSON('package.json'),
            sass: {
                options: {
                    style: 'expanded',
                    // compass: true
                },
                dist: {
                    files: {
                        'public/css/main.css': 'public/scss/main.scss'
                    }
                }
// compile: {
//     dist:{
//         option:{
//              sourceMap: true
//         },
//         
//        files: {
//      'assets/css/stylesheet/main.css': 'scss/main.scss'
//    }  
//     }
//   
//  }                 

            },
            cssmin: {
                target: {
                    files: [{
                            src: cssFiles,
                            dest: 'public/css/custom.css'

                        }]
                }
            },
            watch: {
                sass: {
                    files: ['public/scss/**/*.scss'],
                    tasks: ['sass', 'cssmin']

                }
            }

        });

        // Load the plugin that provides the "uglify" task.
        //grunt.loadNpmTasks('grunt-contrib-compass');
        grunt.loadNpmTasks('grunt-contrib-sass');
        grunt.loadNpmTasks('grunt-contrib-cssmin');
        grunt.loadNpmTasks('grunt-contrib-watch');

        // Default task(s).
        grunt.registerTask('default', ['sass', 'cssmin', 'watch']);

    };
})();
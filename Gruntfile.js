module.exports = function(grunt) {  
    // Project configuration.
    grunt.initConfig({
      pkg: grunt.file.readJSON('package.json'),
      clean: {
        allassets: ['assets/*']
      },
      copy: {
        main: {
          files :[
          {
            expand: true,
            src: 'assets/bower/**',
            dest: 'public/'
          },
          {
            expand: true,
            src: 'assets/img/*',
            dest: 'public/'
          }
          ]
        }
      },
      uglify: {
        options: {
          mangle: {
            reserved: ['jQuery']
          }
        },
        uglify_target: {
          files: {
            'public/assets/main.min.js': ['assets/custom/main.js']
          }
        }
      },
      cssmin: {
        target: {
          files: [{
            expand: true,
            cwd: 'assets/custom/',
            src: ['*.css', '!*.min.css'],
            dest: 'public/assets/',
            ext: '.min.css'
          }]
        }
      },
      browserify: {
        build: {
          src: 'public/assets/main.min.js',
          dest: 'bundle.js'
        }
      },
      shell: {
       cache_clear_prod: {
         options: {
           stdout: true
         },
         command: 'php bin/console cache:clear --env=prod --no-debug'
       }
     }
   });

    // Load the plugin that provides the "clean" task.
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-browserify');
    //grunt.loadNpmTasks('grunt-shell');
    grunt.loadNpmTasks('grunt-contrib-cssmin');



    // Default task(s).
    grunt.registerTask('default', ['cssmin', 'uglify','copy','browserify']); //'clean'

  };
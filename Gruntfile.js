module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    clean: {
      dist: {
        src: ["dist/"]
      }
    },
    replace: {
      dist: {
        src: ['dist/*.css','dist/**/*.php'],
        overwrite: true,
         replacements: [
        {
          from: '@theme_version@',
          to: '<%= pkg.version %>'
        },
        {
          from: '@core_version@',
          to: '<%= pkg.core_version %>'
        },
        {
          from: 'MmmToolsNamespace',
          to: '<%= pkg.tools_namespace %>'
        }]
      }
    },
    copy: {
      dist: {
        files: [
          {expand: true, src: ['*.php', '*.css', '*.png', 'lib/**', 'templates/**'], dest: 'dist/'},
          {expand: true, src: ['assets/admin/**', 'assets/css/**', 'assets/js/**', 'assets/fonts/**', 'assets/img/**'], dest: 'dist/'}
        ]
      }
    },
    compress: {
      dist: {
        options: {
          archive: './mmm-roots.zip',
          mode: 'zip'
        },
        files: [
          { expand: true, cwd: 'dist/', src: ['**/*'] }
        ]
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-text-replace');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-compress');

  grunt.registerTask( 'dist', "Build up distribution folder", ['clean:dist', 'copy:dist','replace:dist','compress:dist']);

};

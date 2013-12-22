module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

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

  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-compress');

  grunt.registerTask( 'dist', "Build up distribution folder", ['copy:dist','compress:dist']);

};

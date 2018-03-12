module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      build: {
        src: ['js/lib/jquery.min.js', 'js/lib/bootstrap.min.js', 'js/lib/jquery-ui.js', 'js/lib/appeared.js', 'js/lib/jquery.matchHeight-min.js', 'js/lib/slick.min.js', 'js/lib/isotope.pkgd.js','js/lib/jquery.magnific-popup.js','js/lib/slick-lightbox.js', 'js/lib/jquery.validate.min.js',  'js/lib/custom.js',  'js/main.js', 'js/lib/nprogress.js'],
        dest: 'js/global.min.js'
      }
    }, 
    watch: {
      files:['js/*.js'],
      tasks:['uglify']
    }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task(s).
  grunt.registerTask('default', ['uglify', 'watch']);

};
module.exports = function(grunt) {

  grunt.initConfig({
      uncss: {
        dist: {
          files: {
            'css/main.css': ['index.html']
          }
      }
    },
    cssmin : {
      dist: {
        files: {
          'css/main.min.css' : ['css/main.css']
        }
      }
    }

  });

   grunt.registerTask('build', [
        'uncss',
        'cssmin'
    ]);

grunt.loadNpmTasks('grunt-uncss');
grunt.loadNpmTasks('grunt-contrib-cssmin');
};
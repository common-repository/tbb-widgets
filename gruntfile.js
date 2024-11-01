module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
		clean: {
		  build: ['assets/css','assets/fonts','assets/js/ace', 'assets/js/<%= pkg.name %>.js'],
		},
    copy:{
      fonts:{
        files: [
        {
          cwd: 'bower_components/font-awesome/fonts',
          expand: true,
          flatten: true,
          src: ['**'],
          dest: 'assets/fonts/',
        }]
      },
      select2:{
        files: [
        {
          cwd: 'bower_components/select2',
          expand: true,
          flatten: true,
          src: ['*.png','*.gif'],
          dest: 'assets/css/',
        }]
      },
      ace:{
        files: [
        {
          cwd: 'bower_components/ace-builds/src-min-noconflict',
          expand: true,
          flatten: true,
          src: ['ace.js','mode-html.js','mode-php.js','theme-chrome.js','worker-html.js','worker-php.js'],
          dest: 'assets/js/ace',
        }]
      },
    },
		uglify: {
		  build: {
	      src: [
					'bower_components/bootstrap/js/collapse.js',
	        'bower_components/bootstrap/js/transition.js',
					'bower_components/select2/select2.js',
					'bower_components/nouislider/jquery.nouislider.js',
					'bower_components/bootstrap-switch/dist/js/bootstrap-switch.js',
					'assets/js/jquery.tbb-widget.js',
	        ],
	        dest: 'assets/js/<%= pkg.name %>.min.js'
		    }
		  },
    concat: {
      js: {
        src: [
				'bower_components/bootstrap/js/collapse.js',
        'bower_components/bootstrap/js/transition.js',
				'bower_components/select2/select2.js',
				'bower_components/nouislider/jquery.nouislider.js',
				'bower_components/bootstrap-switch/dist/js/bootstrap-switch.js',
				'assets/js/jquery.tbb-widget.js',
        ],
        dest: 'assets/js/<%= pkg.name %>.js'
      },
    },
    less:{
      css:{
        options: {
          paths: [
          'bower_components/bootstrap/less',
					'bower_components/font-awesome/less',
					'bower_components/select2',
					'bower_components/nouislider',
					'bower_components/bootstrap-switch/src/less/bootstrap3'
          ]
        },
        files: {
          'assets/css/<%= pkg.name %>.css': 'assets/less/bootstrap.less',
					'assets/css/recent-posts.css': 'assets/less/recent-posts.less',
					'assets/css/recent-comments.css': 'assets/less/recent-comments.less'
        }
      }
    },
  });

	grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	

  grunt.registerTask('default', ['clean','less','uglify','copy']);

};
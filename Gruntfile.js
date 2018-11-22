'use strict';

module.exports = function(grunt) {

	var path = require("path");
	var PWD = process.cwd();

	grunt.initConfig({
	  jshint : {
	    options : {
		    jshintrc : true
	    },
	    files : [ "**/amd/src/*.js" ]
	  },
	  uglify : {
	    deploy : {
	      files : [ {
	        expand : true,
	        cwd : 'amd/src',
	        src : '**/*.js',
	        dest : 'amd/build',
	        rename : function(dst, src) {
		        return dst + '/' + src.replace('.js', '.min.js');
	        }
	      } ]
	    },
	    debug : {
	      options : {
	        sourceMap : true,
	        beautify : true
	      },
	      files : [ {
	        expand : true,
	        cwd : 'amd/src',
	        src : '**/*.js',
	        dest : 'amd/build',
	        rename : function(dst, src) {
		        return dst + '/' + src.replace('.js', '.min.js');
	        }
	      } ]
	    }
	  },
	  clean : [ 'amd/build' ]
	});

	grunt.loadNpmTasks("grunt-contrib-uglify");
	grunt.loadNpmTasks("grunt-contrib-jshint");
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.registerTask("amd", [ "clean", "jshint", "uglify:deploy" ]);
	grunt.registerTask("amddebug", [ "clean", "jshint", "uglify:debug" ]);
};

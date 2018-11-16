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
    dynamic_mappings : {
     files : grunt.file.expandMapping([ "**/src/*.js", "!**/node_modules/**" ], "", {
       cwd : PWD,
       rename : function(destBase, destPath) {
        destPath = destPath.replace("src", "build");
        destPath = destPath.replace(".js", ".min.js");
        destPath = path.resolve(PWD, destPath);
        return destPath;
       }
     })
    }
   },
 });

 grunt.loadNpmTasks("grunt-contrib-uglify");
 grunt.loadNpmTasks("grunt-contrib-jshint");
 grunt.registerTask("amd", [ "jshint", "uglify" ]);
};

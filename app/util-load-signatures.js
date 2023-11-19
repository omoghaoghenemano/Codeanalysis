const expand = require('expand-tilde');
const glob   = require('glob');
const lodash = require('lodash');
const yaml   = require('yamljs');


module.exports = function (options, config) {
 var files = [];
  config.signatures.forEach(function (path) {
      files = files.concat(glob.sync(expand(path)));
  });
  files = lodash(files).sort().uniq().value();
  if (lodash.isEmpty(files)) {
    throw new Error('No signatures were specified.');
  }

  var signatures = [];
  files.forEach(function (file) {
    const yml = yaml.load(file);
    if (! lodash.isObject(yml)) {
      throw new Error(file + ' is not a valid YAML file.');
    }
    if (lodash.isEmpty(yml.filetypes)) {
      throw new Error(file + ' contains no filetypes.');
    }
    if (lodash.isEmpty(yml.patterns)) {
      throw new Error(file + ' contains no patterns.');
    }
    const filetypes = yml.filetypes;
    yml.patterns.forEach(function (pattern) {
      signatures.push({
        signature : pattern,
        filetypes : filetypes.map(function (t) {
          return t.toLowerCase();
        }),
       
      });
    });
  });

  return signatures;
};

/**
 * Static Code Analysis Module
 * Orchestrates the static code analysis process.
 * Handles command-line arguments, configuration, and invokes necessary functions.
 */

process.on('uncaughtException', function (err) {
  console.warn(err);
  process.exit(1);
});
const decorators = require('./design');
const docopt     = require('docopt').docopt;
const fs         = require('fs');
const glob       = require('glob');
const globify    = require('./util-globify');
const path       = require('path');
const pkg        = require('../package.json');
const scan       = require('./util-scan');
const doc        = fs.readFileSync(path.join(__dirname, 'docopt.txt'), 'utf8');
const options    = docopt(doc, { version: pkg.version });
const config     = require('./config')(options);
const signatures = require('./util-load-signatures')(options, config);
var matches = [];


glob(globify(options, signatures), config.glob, function (err, files) {
  

  files.forEach(function (file) {
    matches = scan(file, matches, options, signatures);
  });


  if (decorators[options['--format']] === undefined) {
      throw new Error('Format "' + options['--format'] + '" is invalid.');
  }

//static code logic
  const decorate = decorators[options['--format']];
  console.log(decorate(options, config, matches));
});





const Prism  = require('node-prismjs');
const ejs    = require('ejs');
const fs     = require('fs');
const lodash = require('lodash');
const moment = require('moment');
const path   = require('path');
const sort   = require('./util-sort');
const uuid   = require('uuid-v4');

module.exports = function(options, config, matches) {
  
  const mytemplate = fs.readFileSync(
    path.resolve(__dirname, 'static/app.ejs'),
    'utf8'
  );

  const styles = {

    external: [
      'https://cdnjs.cloudflare.com/ajax/libs/Primer/3.0.1/css/primer.css',
      'https://cdnjs.cloudflare.com/ajax/libs/prism/1.6.0/themes/prism-solarizedlight.min.css',
    ],

    embedded: fs.readFileSync(
      path.resolve(__dirname, 'static/app.css'),
      'utf8'
    ),
  };

  const scripts = {

    external: [
      'https://cdnjs.cloudflare.com/ajax/libs/vue/2.2.4/vue.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js',
    ],

    embedded: fs.readFileSync(
      path.resolve(__dirname, 'static/app.js'),
      'utf8'
    ),

  };

  const selectfiletype = lodash(matches)
    .countBy('filetype')
    .toPairs()
    .sortBy(function(pa) {
      return pa[0];
    })
    .value();
  selectfiletype.unshift([
    'all',
    matches.length,
  ]);

  var tmp = {};
  matches.forEach(function (match) {
    var path  = [ match.filetype, match.search ].join('.');
    var value = lodash.get(tmp, path, 0);
    lodash.set(tmp, path, ++value);
  });
  searches = [];
  Object.keys(tmp).forEach(function (filetype) {
    lodash.toPairs(tmp[filetype]).forEach(function (pair) {
      searches.push({
        filetype : filetype,
        search   : pair[0],
        count    : pair[1],
      });
    });
  });
  searches = lodash.sortBy(searches, 'search');

  matches = matches.map(function (match) {
    
    match.

severity = 'unknown';

    match.note = '';

    match.match = Prism.highlight(
      match.match,
      Prism.languages.autoit
    );

    var number = match.start;
    match.match = match.match.split('\n').map(function (line) {
      var numbered = '<span class="line-number">' + (number) + ':</span> ' + line;

      if (number === match.line) {
        numbered = '<span class="highlight">' + numbered + '</span>';
      }


      number++;


      return numbered;
    }).join('\n');

    return match;
  });


  const data = {
    meta: {
      date      : moment(new Date()).format(config.dateFormat),
      project   : options['--project'],
      scripts   : scripts,
      storage   : 'oliseh-' + uuid(),
      styles    : styles,
    },
    filetype   : 'all',
    filetypes  : JSON.stringify(selectfiletype, null, ' '),
    matches    : JSON.stringify(sort(matches), null, ' '),
    searches   : JSON.stringify(searches, null, ' '),
    severities : JSON.stringify([ 'Low', 'Medium', 'High', 'unknown' ]),
  };


  return ejs.render(mytemplate, data, {});
};

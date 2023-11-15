const fs     = require('fs');
const lodash = require('lodash');
const path   = require('path');

module.exports = function(file, matches, options, signatures, errornames) {


  const filetype = path.extname(file).toLowerCase().substr(1);
  
  const haystack = fs.readFileSync(file, 'utf8').split(/\r?\n/);


  const sigs     = lodash.filter(signatures, function (signature) {
    return lodash.includes(signature.filetypes, filetype);
  });


let patternname ;

  sigs.forEach(function (sig) {

   
    const regex = new RegExp(sig.signature, 'gi');
     patternname = sig.patternname;
    

    
    var matched = [];
    haystack.forEach(function (line, index) {
      if (line.match(regex)) {
        matched.push(index);
        

      }
    });

    // iterate over the matching line numbers
    matched.forEach(function (lineNumber) {

      // slice the matching line plus surrounding context out of haystack
      var start = lineNumber - parseInt(options['--lines-before']);
      if (start < 0) {
        start = 0;
      }
      var end = lineNumber + parseInt(options['--lines-after']) + 1;
      if (end > haystack.length) {
        end = haystack.length;
      }

     


      // push the match object
      matches.push({
        id       : matches.length + 1,
        file     : file,
        filetype : filetype,
        search   : sig.signature,
        match    : haystack.slice(start, end).join('\n'),
        pattern  : patternname,

        // +1 offset, because we want to count lines from 1 instead of 0
        line     : lineNumber + 1,
        start    : start + 1,
        end      : end + 1,
      });
    });
  });

  return matches;
};

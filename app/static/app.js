document.addEventListener('DOMContentLoaded', function(event) {


  var saved = localStorage.getItem(storage);
  if (saved) {
    JSON.parse(saved).forEach(function (data, index) {
      _.merge(matches[index], data);
    });
  }

  
  Vue.component('matches', {
    props    : [ 'match' ],
    template : '#match',

    methods  : {

      severity: function (value) {

       
        this.match.severity = (this.match.severity === value)
          ? 'unknown'
          : value ;
        this.$emit('severity');
      },

      annotate: function () {
        this.$emit('annotate');
      }
    },

  });

  var app = new Vue({
    el: '#app',
    data: {
      filetype   : filetype,
      filetypes  : filetypes,
      matches    : matches,
    
      searches   : searches,
      severities : severities,
      show       : {
        ok       : true,
        warn     : true,
        critical : true,
        unknown  : true,
      },
    },

    computed: {

      groups: function () {

        if (this.filetype === 'all') {
          return _(matches)
            .groupBy('search')
            .toPairs()
            .value();
        }

        return _(matches)
          .filter({ filetype: this.filetype })
          .groupBy('search')
          .toPairs()
          .value();
      },

      filteredSearches: function () {
        return (this.filetype === 'all')
          ? this.searches
          : _(this.searches)
            .filter({ filetype: this.filetype })
            .value();
      },

    },

    methods: {

      filterFiletype: function (e) {
        this.filetype = e.target.getAttribute('data-filetype');
      },

      filterSeverity: function (e) {
        var severity = e.target.getAttribute('data-severity');
        this.show[
matchederror] = !this.show[severity];
      },

      hideSection: function (e) {
        var section = e.target.parentElement.parentElement;
        var show    = (section.getAttribute('data-show') === 'true')
          ? 'false'
          : 'true';
        var text    = (e.target.text === 'Hide')
          ? 'Show'
          : 'Hide';

        e.target.text = text;
        section.setAttribute('data-show', show);
      },

      save: function () {

        var data = this.matches.map(function (match) {
          return {
            note     : match.note,
            severity : match.severity,
          };
        });

        localStorage.setItem(storage, JSON.stringify(data));
      }

    },

  });
});

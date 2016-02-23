/**
 * Get partial views from server.
 */
var DashboardPartial = (function(){

    var _getPartialView = function () {

        return $.ajax({
            url: _url,
            async: true,
        });

    };

    return  {
        get: function (url) {
            _url = url;
            return _getPartialView();
        }

    };

}());

/**
 * Make ajax calls to server,
 * specifying type (POST,GET, etc), url, and
 * data submitted.
 */
var ServerCall = (function (){

    var _sendRequest = function(type, url, data) {

        return $.ajax({
            type: type,
            url: url,
            data: data,
            async: true,
        });
    };

    return {
        request: function(type, url, data) {
            return _sendRequest(type, url, data);
        }
    };

}());



/**
 * Display errors.
 */
var ServerError = (function (response) {
    
    if( response.status !== undefined )
    {
        if( response.status === 401 ) //Invalid authentication
        {
            localStorage.removeItem('token');
            window.location.href = '/admin/login';
            return;
        }
    }

    var defaultMessage = 'There seems to be a problem with the server,' +
        'please try again or contact support if problem persists.';

    var message = response.responseJSON.error || defaultMessage;

    return swal({title: "Whoops!",
            text: message,
            type: "error",
            confirmButtonColor: "#DA4453",
            confirmButtonText: "Ok"},
        function(){
            window.location.href = '/';
        });

});

/**
 * Filter tables with any text.
 */
var TableFilter = (function () {

    var _caseInsensitiveContains = function () {

        // Case insensitive alternative to jquery contains.
        jQuery.expr[':'].Contains = function(a, i, m) {
            return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };

    };

    var _initFilter = function (inputSelector) {

        $(inputSelector).keyup(function () {
            //split the current value of searchInput
            var data = this.value.split(" ");
            //create a jquery object of the rows
            var rowObject = $("tbody").find("tr");
            if (this.value == "") {
                rowObject.show();
                return;
            }
            //hide all the rows
            rowObject.hide();

            //Recursively filter the jquery object to get results.
            rowObject.filter(function (i, v) {
                var $t = $(this);
                for (var d = 0; d < data.length; ++d) {
                    if ($t.is(":Contains('" + data[d] + "')")) {
                        return true;
                    }
                }
                return false;
            })
                //show the rows that match.
                .show();
        }).focus(function () {
            this.value = "";
            $(this).css({
                "color": "black"
            });
            $(this).unbind('focus');
        }).css({
            "color": "#C0C0C0"
        });

    };

    return {
        init: function (inputSelector) {
            _caseInsensitiveContains();
            _initFilter(inputSelector);
        }
    };

}());


/*
 * This function grabs all input fields from the given form with id.
 */
var input = (function(id) {
    //return $(id).serializeArray();
    return $(id).map(function() {
        return { name : this.name, value: this. value };
    });
});

/*
 * This function serializes input.
 */
var objectSerialize = (function (identifier) {
    var input = this.input(identifier);
    return _(input).reduce(function(acc, field) {
        acc[field.name] = field.value;
        return acc;
    },{});
});

/*
 * This function assigns validation errors returnedwith ajax response to corresponding form field.
 */
var assignErrorToField = (function (error, key) {
    var field = $('[name='+key+']') ;

    $(field).next('.validation-error').html(error);
});

/*
 *Loops through validation errors and calls function that renders them.
 */
var showErrors = (function (response) {

    $('.validation-error').text('');

    var json = response.responseJSON;
    var text = JSON.parse(response.responseText);

    var errors = typeof json !== 'undefined' ? json : text;

    _.each(errors, function(num, key) {
        console.log(num);
        assignErrorToField(num, key);
    });

});

/**
 * Initialize twitter typeahead input.
 * @param url: url of desired resource search service.
 * @param query: query for database search.
 * @param displayKey: object key of result to be displayed.
 * @param callback: function to execute on suggestion select.
 */
function TypeAhead(inputElement, url, query, displayKey, callback) {

    var config = {};

    var _setConfig = function (url, query, displaykey, callback) {
        config.url = url;
        config.query = query;
        config.displayKey = displaykey;
        config.callback = callback;
    };

    var _startEngine = function () {
        var engine = new Bloodhound({
            remote: {
                cache: false,
                url: config.url+'?'+config.query+'=%QUERY',
                wildcard: '%QUERY',
            },

            datumTokenizer: Bloodhound.tokenizers.whitespace(config.displayKey),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        config.engine = engine;
    }

    var _initSearch = function (inputElement) {

        $(inputElement).typeahead({
            highlight: true,
            hint: false,
            minLength: 2
        }, {
            name: 'engine',
            limit: 10,
            displayKey: config.displayKey,
            source: config.engine.ttAdapter(),
            templates: {
                empty: [
                    '<div class="empty-suggestion-message">',
                    'No results matched your query.',
                    '</div>'
                ].join('\n'),
                suggestion: Handlebars.compile('<p> <span>{{name}}</span> </p>'),
            }
        }).bind('typeahead:select', function(ev, suggestion) {

            $(inputElement).typeahead('val','');

            config.callback(suggestion);

        });

    };

    _setConfig(url,query,displayKey, callback);
    _startEngine();
    _initSearch(inputElement);
};

/**
 * HandleBars Shortcut.
 *
 * @param templateId
 * @param context
 * @returns {*}
 * @constructor
 */
function HandlebarsCompile(templateId, context){

    var source   = $(templateId).html();

    var template = Handlebars.compile(source);

    return template(context);

};

/**
 * Add row dinamically to table.
 *
 * @param tableId
 * @param html
 * @constructor
 */
function AddRow(tableId, html){

    $(tableId).children("tbody").append(html);

};


/* resources/src/routers/app-router.js */

/**
 * Application Main Router
 */
AppRouter = Backbone.Router.extend({

    container: null,

    initialize: function() {

    },

});

WINDOW = $(window);
DOCUMENT = $(document);
BODY   = $('body');
CONTAINER_ELEMENT = $("#container");
Marionette.TemplateCache.prototype.loadTemplate = function ( templateId ) {
    var template = '',
        url = '/templates/' + templateId + '.html';

    // Load the template by fetching the URL content synchronously.
    Backbone.$.ajax( {
        async   : false,
        url     : url,
        success : function ( templateHtml ) {
            template = templateHtml;
        }
    } );

    return template;
};

// Instruct Marionette to use Handlebars.
Marionette.TemplateCache.prototype.compileTemplate = function ( template ) {
    return Handlebars.compile( template );
};

var GardenRevApp = new Marionette.Application();

GardenRevApp.AdminLayoutView = Marionette.LayoutView.extend({
    el: 'body',
    regions: {
        mainRegion: "#app",
    }
});

GardenRevApp.IndexView = Marionette.ItemView.extend({
    template: Marionette.TemplateCache.get('partials/index', {data: 'data'})
});

GardenRevApp.UserAdmin = new GardenRevApp.AdminLayoutView();

GardenRevApp.UserAdmin.getRegion('mainRegion').show(new GardenRevApp.IndexView());
//# sourceMappingURL=app.js.map

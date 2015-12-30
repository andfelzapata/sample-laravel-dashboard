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
 * Display errors.
 */
var serverError = (function (response) {

    var defaultMessage = 'There seems to be a problem with the server,' +
        'please try again or contact support if problem persists.';

    var message = response.responseJSON.error || defaultMessage;

    return swal({title: "Whoops!",
            text: message,
            type: "error",
            confirmButtonColor: "#DA4453",
            confirmButtonText: "Ok"},
        function(){
            window.location.href = '/dashboard';
        });

});
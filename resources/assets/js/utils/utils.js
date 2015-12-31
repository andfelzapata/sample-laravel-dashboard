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
            async: true

        });
    };

    return {
        request: function(type, url, data) {
            console.log(url);
            return _sendRequest(type, url, data);
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
            window.location.href = 'admin/dashboard';
        });

});
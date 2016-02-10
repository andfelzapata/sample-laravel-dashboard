var Login = (function() {

    var _ajaxSuccess = function(jqXHR) {
        if (jqXHR.status === 200) { //redirect if  authenticated user.
            window.location.href = _redirect;
        }
    };

    var _ajaxError = function(data) {
        if (data.status === 401) { //redirect if not authenticated user
            var errors = data.responseJSON.msg;
            errorsHtml = '<div class="alert alert-danger">' + errors + '</div>';
            $('#form-errors').html(errorsHtml);
        }

        if (data.status === 422) {
            //process validation errors here.
            var errors = data.responseJSON;

            errorsHtml = '<div class="alert alert-danger"><ul>';

            $.each(errors, function(key, value) {
                errorsHtml += '<li>' + value[0] + '</li>';
            });
            errorsHtml += '</ul></di>';

            $('#form-errors').html(errorsHtml);
        } else {

        }
    };

    var _submitAjaxRequest = function(e) {
        e.preventDefault();
        $.ajax({

            type: _method,

            url: _form.prop('action'),

            data: _form.serialize(),

            success: function(NULL, NULL, jqXHR) {
                _ajaxSuccess(jqXHR);
            },

            error: function(data) {
                _ajaxError(data);
            }
        });

    };

    var _bindForm = function(form) {
        $(form).on('submit', _submitAjaxRequest);
    };

    return {
        init: function(form, redirect) {
            _form = $(form);
            _redirect = redirect;
            _method = _form.find('input[name="_method"]').val() || 'POST'; //Laravel Form::open() creates an input with name _method
            _bindForm(form);
        }
    };

})();

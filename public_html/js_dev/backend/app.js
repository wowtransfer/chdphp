define([
    'jquery'
], function($) {

    var app = {};

    app.getBaseUrl = function () {
        return "admin.php?r=";
    };

    app.showMessage = function (message) {
        var $dialog = $("#dialog");
        $dialog.find(".modal-body").html(message);
        $dialog.modal();
    };

    app.beginLoading = function (message) {

    };

    app.endLoading = function () {

    };

    return app;
});

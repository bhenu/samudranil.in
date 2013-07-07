$(function () {
    "use strict";
    var SROY = {
            'url' : 'ajax.php',
            'sendRequest' : function () {
                $.getJSON(this.url, this.sendData, function (data) {
                    $("#container").html("<pre>" + data.url + "</pre>");
                });
            },
            'sendData' : {
                'type' : 'albums',
                'thumbsize' : '256c'
            },

        };

    SROY.sendRequest();


});

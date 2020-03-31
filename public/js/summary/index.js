$(function () {
    $("#datepicker-from").datepicker(
        Object.assign({
                'onClose': function () {

                }
            },
            $.datepicker.regional["ru"]
        )
    );
    $("#datepicker-to").datepicker(Object.assign({
            'onClose': function () {

            }
        },
        $.datepicker.regional["ru"]
    ));
});

$(document).ready(function () {

    $("#datepicker-from").val(getUrlParam('from_date'));
    $("#datepicker-to").val(getUrlParam('to_date'));

    $('#summary-date-filter').click(function () {

            let fromDate = $("#datepicker-from").val();
            let toDate = $("#datepicker-to").val();

            if (fromDate !== '' || toDate !== '') {
                let url = window.location.href;
                url = updateURLParameter(url, 'from_date', fromDate);
                url = updateURLParameter(url, 'to_date', toDate);
                window.location.href = url;
            }

        }
    );
});

function updateURLParameter(url, param, paramVal) {
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";
    if (additionalURL) {
        tempArray = additionalURL.split("&");
        for (var i = 0; i < tempArray.length; i++) {
            if (tempArray[i].split('=')[0] != param) {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }

    var rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}

function getUrlParam(parameter, defaultvalue) {
    var urlparameter = defaultvalue;
    if (window.location.href.indexOf(parameter) > -1) {
        urlparameter = getUrlVars()[parameter];
    }
    return urlparameter;
}

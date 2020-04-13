$(document).on('click', '.applyBtn', function () {

    let datetime = $('input[name=daterange-centered]').val();
    let dtAr = datetime.split(' - ');

    let fromDate = dtAr[0];
    let toDate = dtAr[1];
    localStorage.setItem('fromDate', fromDate);
    localStorage.setItem('toDate', toDate);

    if (fromDate !== '' || toDate !== '') {
        let url = window.location.href;
        url = updateURLParameter(url, 'from_date', fromDate);
        url = updateURLParameter(url, 'to_date', toDate);
        window.location.href = url;
    }
});

$(document).ready(function () {

    $("#datepicker-from").val(getUrlParam('from_date'));
    $("#datepicker-to").val(getUrlParam('to_date'));

    $('.applyBtn').click(function () {



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

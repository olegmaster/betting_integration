

$(document).ready(function () {
    $('#rowTab a:first').tab('show');

//for bootstrap 3 use 'shown.bs.tab' instead of 'shown' in the next line
    $('a[data-toggle="tab"]').on('click', function (e) {
        console.log(e.target)
//save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('selectedTab', $(e.target).attr('id'));
    });

//go to the latest tab, if it exists:
    var selectedTab = localStorage.getItem('selectedTab');
    if (selectedTab) {
        $('#'+selectedTab).tab('show');
    }
});

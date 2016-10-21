jQuery('.cleaning-box .book-now-btn').click(function (e) {
    e.preventDefault();
    //jQuery('#addonModal').modal('show');
    jQuery('#btn-no').attr('href', $(this).attr('href'));
    $('#customize-plan-steps').removeClass('hide');
    $('#btn-yes').trigger('click');
});

jQuery(document).on('click', '#btn-yes', function () {
    var h = jQuery('#btn-no').attr('href');
    var plan = getParameterByName('plan', h);
    jQuery('#addonModal').modal('hide');
    //window.location.hash = '#customize-plan-steps';
    $('html, body').animate({
        scrollTop: $("#customize-plan-steps").offset().top
    }, 1500);
    jQuery('input[name="plan"]').val(plan);
    jQuery('#addon-note').addClass('hide');
    jQuery('#like-us-submit').removeAttr('disabled');
    jQuery('#like-us-submit').removeClass('disabled');
    jQuery('#extra_customize').remove();
});

function getParameterByName(name, url) {
    if (!url)
        url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

jQuery(".range-div").click(function () {
    var steps = jQuery(this).attr("step-tag");
    $('#hmbaths').val(steps);
});

jQuery(".range-div1").click(function () {
    var steps = jQuery(this).attr("step-tag1");
    $('#hmbeds').val(steps);
});
jQuery(".all-no").click(function () {
    var no = jQuery(this).text();
     $('#hmbaths').val(no);
});

jQuery(".all-no1").click(function () {
    var no = jQuery(this).text();
     $('#hmbeds').val(no);
});	
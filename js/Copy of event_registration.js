$(document).ready(function () {
    var $cbs = $('.checkbox');
    var $ptr = $('.part-cnt');
    $flag = 0;
    function calcUsage() {
        var total = 0;

        if ($flag == 0) {
            $cbs.each(function () {
                if ($(this).is(":checked")) {
                    $chname = String($(this).attr("name"));
                    $part_cnt = parseInt($("#" + $chname + " option:selected").val());
                    total = parseFloat(total) + parseFloat($(this).val() * ($part_cnt + 1));
                }
            });
        } else {
            $ptr.each(function () {
                $cnt = parseInt($(this).val());
                if ($cnt > 0) {
                    $chname = String($(this).attr("name"));
                    $amt = parseInt($("input[name='" + $chname + "']:checked").val());
                    if (!$amt)
                        $amt = 0;
                    total = parseFloat(total) + parseFloat($amt * ($cnt + 1));
                }
            });
        }

        country_code = $('#country_code').val();
        if (country_code == "IN") {
            res = getIndianCurrencyFormat(total);
            $("#sum").html('INR' + res);
        } else {
            $("#sum").html('USD' + total);
        }
        $('#total').val(total);
    }

    $ptr.change(function () {
        $flag = 1;
        calcUsage();
    });

    $cbs.click(function () {
        $flag = 0;
        calcUsage();
    });

    $("#submit-event-reg").click(function () {
        if ($('input[type=checkbox]:checked').length == 0)
        {
            alert('Please select the package');
            return false;
        }
    });

    function getIndianCurrencyFormat(total) {
        x = total.toString();
        var lastThree = x.substring(x.length - 3);
        var otherNumbers = x.substring(0, x.length - 3);
        if (otherNumbers != '')
            lastThree = ',' + lastThree;
        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;

        return res;
    }
});

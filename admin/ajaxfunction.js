//Doorgeven van waarde die uit dropdown komt van pre-edit.php (Wijzigen van metingen)
$(document).ready(function () {

    // Your code here.
    var selecteer_verf = "";

    console.log("werkt");
    $('select[name="selecteer_verf"]').change(function () {
        //console.log($(this).val());
        selecteer_verf = $(this).val();

        $.ajax({
            /* THEN THE AJAX CALL */
            method: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
            url: "functions.php", /* PAGE WHERE WE WILL PASS THE DATA */
            data: {
                selecteer_verf: selecteer_verf
            }
        }).done(function (data) {
            console.log(data);
            $("#kleur").empty().append(data); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
        });

    });

});

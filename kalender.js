//$(this).siblings("input").val();
$(document).ready(main);

function main() {

    var nextMonth = "";
    var prevMonth = "";
    initListeners();
    getDatum();
}

function initListeners() {
    $('.btnNext').click(function () {
        console.log('nextMonth klickad');
        $('#kalender').children().remove();
        console.log(nextMonth);
        getDatum(nextMonth);
    });//click button
}

function addDateListener() {
    $('.bookableDay').click(function () {
        $('.days').hide();
        console.log("dag klickad");
        getTider($(this));
    });//click bookable
}

function addTimeListener() {
    $('.bookableTime').click(function () {
        $('.days').hide();
        console.log("tid klickad");
        $('#dag').slideToggle();
        $('#bokningsform').slideToggle();
        $('#starttid').val($(this).attr("data-date"));
        $('#selectedDate').text($('#starttid').val().substr(0, 10));
        $('#selectedTime').text($('#starttid').val().substr(11, 5));
    });//click bookable
}

function getTider(e) {
//console.log("hej");
    var starttid = $(e).text();
    console.log(starttid);
    $('#kalender').slideToggle();

    $.getJSON("getTider.php", {starttid: starttid})
            .done(function (data) {
                console.log(data);
                var tmp_html = "";
                console.log(value.starttid);
                $.each(data, function (key, value) {
                    console.log(key + ", " + value.starttid);
                    tmp_html = tmp_html + "<li class='bookableTime' data-date='" + value.starttid + "'>" + value.starttid + "</li>";
                });//.each
                tmp_html = "<ul>" + tmp_html + "</ul>";
                $('#dag').append(tmp_html);
                $('#dag').slideToggle();
                addTimeListener();
            });//done + getJSON
}//getDatum

function getDatum(date) {
    $.getJSON("getDatum.php", {date: date})
            .done(function (data) {
//                console.log(data);
                var tmp_html = "";
//                var tmp_html2;
                $.each(data, function (key, value) {
                    var datum = value.starttid.substr(8, 2);
                    tmp_html = tmp_html + "<li class='" + value.class + "'>" + datum + "</li>";
//                    tmp_html2 = tmp_html + "<li class='" + value.class + "'>" + value.starttid + "</li>";
                    //kolla slut av vecka och skriv till veckan och resetta
                    if (key % 7 == 6) {
                        tmp_html = "<ul>" + tmp_html + "</ul>";
                        $('#kalender').append(tmp_html);
                        tmp_html = "";
                    }
                });//.each
                tmp_html = "<ul>" + tmp_html + "</ul>";
                $('#kalender').append(tmp_html);
                addDateListener();
                nextMonth = data[0]["nextMonth"];
                prevMonth = data[0]["prevMonth"];
            });//done + getJSON
}//getDatum


//function addBookingListeners() {
//    $("form").submit(function (event) {
//        console.log("submit fångad, förbereder getJSON");
//        event.preventDefault();
//
//
////        console.log(selectedDate);
//
//
//
//        var starttid = $('#starttid').val();
//        var kundNamn = $('#kundNamn').val();
//        var kundTelefon = $('#kundTelefon').val();
//        var kundMail = $('#kundMail').val();
//
//
//        $.getJSON("bokaTid.php", {starttid: selectedDate, kundNamn: kundNamn, kundTelefon: kundTelefon, kundMail: kundMail})
//                .done(function (data) {
//                    console.log(data);
//                });//done + getJSON
//
//    });//submit
//
//}

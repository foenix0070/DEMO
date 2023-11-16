(function () {

    "use strict";

    var cookieAlert = document.querySelector(".cookiealert");

    var acceptCookies = document.querySelector(".acceptcookies");
    var rejectcookies = document.querySelector(".rejectcookies");
    var parametrecookies = document.querySelector(".parametrecookies");
    var retourcookies = document.querySelector(".retourcookies");
    var savecookies = document.querySelector(".savecookies");

    var nospartenaires = document.querySelector(".nospartenaires");
    var retourcookies2 = document.querySelector(".retourcookies2");
    var savecookies2 = document.querySelector(".savecookies2");
    var rejectcookies2 = document.querySelector(".rejectcookies2");

    var chartecookie = document.querySelector(".chartecookie");
    var chartecookie2 = document.querySelector(".chartecookie2");
    var retourcookies3 = document.querySelector(".retourcookies3");

    if (!cookieAlert) {

       return;
    }

    cookieAlert.offsetHeight; // Force browser to trigger reflow (https://stackoverflow.com/a/39451131)

    // Show the alert if we cant find the "acceptCookies" cookie

    if (!getCookie("acceptCookies")) {
        cookieAlert.classList.add("show");
    }

    // When clicking on the agree button, create a 1 year

    // cookie to remember user's choice and close the banner
    acceptCookies.addEventListener("click", function () {
        setCookie("acceptCookies", true, 365);
        cookieAlert.classList.remove("show");
        // dispatch the accept event
        window.dispatchEvent(new Event("cookieAlertAccept"))
    });

    rejectcookies.addEventListener("click", function () {
        setCookie("acceptCookies", false, 365);
        cookieAlert.classList.remove("show");
        // dispatch the accept event
        window.dispatchEvent(new Event("cookieAlertAccept"))
    });

    rejectcookies2.addEventListener("click", function () {
        setCookie("acceptCookies", false, 365);
        cookieAlert.classList.remove("show");
        // dispatch the accept event
        window.dispatchEvent(new Event("cookieAlertAccept"))
    });

    // Paramétrage des cookie
    parametrecookies.addEventListener("click", function () {

        $('#contentPopupConsent').fadeOut(0);
        $('#configurePartenaire').fadeOut(0);

        $('#notrechartecookie').fadeOut(0);

        $('#configureSection').fadeIn(1000);
    });

    // Paramétrage des Partenaires
    nospartenaires.addEventListener("click", function () {

        $('#contentPopupConsent').fadeOut(0);
        $('#configureSection').fadeOut(0);

        $('#notrechartecookie').fadeOut(0);

        $('#configurePartenaire').fadeIn(1000);
    });

    // Paramétrage des cookie
    retourcookies.addEventListener("click", function () {
        $('#contentPopupConsent').fadeIn(1000);
        $('#configureSection').fadeOut(0);
        $('#configurePartenaire').fadeOut(0);

        $('#notrechartecookie').fadeOut(0);
    });

    // Paramétrage des cookie
    retourcookies2.addEventListener("click", function () {
        $('#contentPopupConsent').fadeIn(1000);
        $('#configureSection').fadeOut(0);
        $('#configurePartenaire').fadeOut(0);

        $('#notrechartecookie').fadeOut(0);
    });

    // Paramétrage de notre charte cookie
    chartecookie.addEventListener("click", function () {

        $('#contentPopupConsent').fadeOut(0);
        $('#configureSection').fadeOut(0);
        $('#configurePartenaire').fadeOut(0);

        $('.title_h4, .title_h6').hide();

        $('#notrechartecookie').fadeIn(1000);
    });

    // Paramétrage de notre charte cookie2
    chartecookie2.addEventListener("click", function () {

        $('#contentPopupConsent').fadeOut(0);
        $('#configureSection').fadeOut(0);
        $('#configurePartenaire').fadeOut(0);

        $('.title_h4, .title_h6').hide();

        $('#notrechartecookie').fadeIn(1000);
    });




    // Paramétrage des Partenaires
    retourcookies3.addEventListener("click", function () {

        $('#contentPopupConsent').fadeOut(0);
        $('#configureSection').fadeOut(0);

        $('#notrechartecookie').fadeOut(0);

        $('.title_h4, .title_h6').show();

        $('#configurePartenaire').fadeIn(1000);
    });


    // cookie to remember user's choice and close the banner
    savecookies.addEventListener("click", function () {
        setCookie("acceptCookies", true, 365);
        cookieAlert.classList.remove("show");
        // dispatch the accept event
        window.dispatchEvent(new Event("cookieAlertAccept"))
    });


    // Cookie functions from w3schools

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }


    function getCookie(cname) {

        var name = cname + "=";

        var decodedCookie = decodeURIComponent(document.cookie);

        var ca = decodedCookie.split(';');

        for (var i = 0; i < ca.length; i++) {

            var c = ca[i];

            while (c.charAt(0) === ' ') {

                c = c.substring(1);

            }

            if (c.indexOf(name) === 0) {

                return c.substring(name.length, c.length);

            }

        }

        return "";

    }

})();
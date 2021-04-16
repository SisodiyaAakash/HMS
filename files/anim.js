// jQuery animation for mobile menu toggler
var opened = false;
$(document).ready(function(){
    $(".toggler").click (function () {
        if (opened === true) {
            // Logic for close menubar
            $(".menu").css("height", "0");
            $(".menu a").css("display", "none");
            $(".menu .dropbtn").css("display", "none");
            $(".nav-container").css("background-color", "rgba(255, 255, 255, 0.5)");
            $(".top-nav svg").css("fill", "#222E54");
            $(".toggler svg").css("transform", "rotate(-0deg)");
            $(".toggler svg").css("transition", "500ms");
            $(".login").css("display", "none");
            
            opened=false;
        }
        else {
            // Logic for open menubar
            $(".menu").css("height", "80vh");
            $(".menu a").css("display", "block");
            $(".menu .dropbtn").css("display", "block");
            $(".nav-container").css("background-color", "#222E54");
            $(".top-nav svg").css("fill", "#fff");
            $(".toggler svg").css("transform", "rotate(-180deg)");
            $(".toggler svg").css("transition", "500ms");
            $(".menu a").css("animation-name","fade-in-down");
            $(".menu a:nth-child(1)").css("animation-duration","500ms");
            $(".menu a:nth-child(2)").css("animation-duration","800ms");
            $(".menu a:nth-child(3)").css("animation-duration","1100ms");
            $(".menu a:nth-child(4)").css("animation-duration","1400ms");
            $(".menu a:nth-child(5)").css("animation-duration","1700ms");
            $(".login").css("display", "block");
            $(".login").css("animation-name", "fade-in-right");
            $(".login").css("animation-duration","1700ms");
            
            opened=true;
        }
    })
});
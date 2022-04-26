$("#about").click(function() {
    $.ajax({
        url: "scripts/about.php",
        success: function(result) {
            $("#main").html(result);
        }
    });
});

$("#index").click(function() {
    $.ajax({
        url: "scripts/main.php",
        success: function(result) {
            $("#main").html(result);
        }
    });
});

$("#title").click(function() {
    $.ajax({
        url: "scripts/main.php",
        success: function(result) {
            $("#main").html(result);
        }
    });
});

$("#iphone").click(function() {
    $.ajax({
        url: "scripts/iphone.php",
        success: function(result) {
            $("#main").html(result);
        }
    });
});

$("#applewatch").click(function() {
    $.ajax({
        url: "scripts/applewatch.php",
        success: function(result) {
            $("#main").html(result);
        }
    });
});

$("#login").click(function() {
    $.ajax({
        url: "scripts/login.php",
        success: function(result) {
            $("#main").html(result);
        }
    });
});

$("#cart").click(function() {
    $.ajax({
        url: "scripts/cart.php",
        success: function(result) {
            $("#main").html(result);
        }
    });
});
jQuery(document).ready(function($) {
    var conn = new WebSocket('ws://coin-toss.dev:3000');
    conn.onmessage = function(e) { onMessage(e.data); };
    $(".auto-form").submit(function (e) {
        e.preventDefault();
        $(".oathmaster-result").html("");
        $(".status").html("");
        var form = $(this);
        var data = form.serialize();
        var url = form.attr("action");
        callAjax(
            url,
            data,
            function (data) {
                $(".status").html("Pair has been inserted, coin ritual started...stand by honorable Oathmaster");
                waitForSocketConnection(conn, function() {
                    var msg = {
                        type: "begin",
                        pair: data.insertedId
                    };
                    conn.send(JSON.stringify(msg));
                });
            },
            function (xhr, errorMsg, thrownError) {
                alert("something went awfully wrong...");
            }
        );
    }); 
});

function waitForSocketConnection(socket, callback){
    setTimeout(
        function () {
            if (socket.readyState === 1) {
                console.log("Connection is made")
                if(callback != null){
                    callback();
                }
                return;

            } else {
                console.log("wait for connection...")
                waitForSocketConnection(socket, callback);
            }

        }, 5); // wait 5 milisecond for the connection...
}

function onMessage(data)
{
    console.log(data);
    $(".pair-in-run").empty();
    var obj = JSON.parse(data);
    var clone = $(".pair-placeholder").clone().show();
    clone.find(".warrior1 span").text(obj.warrior1.name + " of " + obj.hunter.galaxy);
    clone.find(".warrior2 span").text(obj.warrior2.name + " of " + obj.hunter.galaxy);
    $(".pair-in-run").append(clone);
    setTimeout(function() {
        $(".oathmaster-result").html("Hunter: " + obj.hunter.name + " of " + obj.hunter.galaxy + "<br />Hunted: " +
            obj.hunted.name + " of " + obj.hunted.galaxy);
        $(".pair-in-run .hunter span").text(obj.hunter.name);
        $(".pair-in-run .hunted span").text(obj.hunted.name);
    }, 8000);
}

function callAjax(url, data, success, error, async) {
    if (typeof async === "undefined") {
        async = true;
    }
    jQuery.ajax({
        type: "POST",
        url: url + "?ajax=1",
        data: data,
        dataType: "json",
        async: async,
        success: success,
        error: error
    });
}

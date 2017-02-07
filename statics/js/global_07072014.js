var Gtaxi = {};
(function(){
    //var a = document.location.protocol + "//" + document.location.host + "/taksi-dev/";
    var a = document.location.protocol + "//" + document.location.host + "/webdriver/manual/";
	var sskey = "";
    function b(c) {
        return c.replace(/[^a-zA-Z0-9\/=?&_]/gi, "")
    }
    Gtaxi.base_url = function() {
        return a
    };
    Gtaxi.site_url = function(c) {
        return a + b(c)
    };
    Gtaxi.setkey = function(d) {
        sskey = d;
    }
    Gtaxi.getkey = function(){
        return sskey;
    }
});

/**
 * https://github.com/handaoliang/html5ImageUploader
 * Licensed under GNU GPL 2 or later and GNU LGPL 2 or later.
 */

var comnovo = {
    version:"0.1",
    Browser: (function(){
        var ua = navigator.userAgent;
        var isOpera = Object.prototype.toString.call(window.opera) == '[object Opera]';
        return {
            IE:             !!window.attachEvent && !isOpera,
            Opera:          isOpera,
            WebKit:         ua.indexOf('AppleWebKit/') > -1,
            Gecko:          ua.indexOf('Gecko') > -1 && ua.indexOf('KHTML') === -1,
            MobileSafari:   /Apple.*Mobile/.test(ua)
        }
    })()
};

(function(base) {
    /**
     * Create Util
     **/
    var util = null;
    if(base && typeof base == "object"){
        if(!base.util){
            base.util = {};
        }
        util = base.util;
    }else{
        window.util = {};
        util = window.util;
    }

    /**
     * Create the namespace if not existed
     * @ns, the namespace string, for example "comnovo.com"
     **/
    util.initNameSpace = function(ns) {
        var parentObj = window;
        var arNs = ns.split('.');
        do {
            var nowNs = arNs.shift();
            if (typeof parentObj[nowNs] != 'object') {
                parentObj[nowNs] = {};
            }
            parentObj = parentObj[nowNs];
        } while (arNs.length > 0)
        return util.decode(ns);
    };

    /**
     * Decode a json string
     * @param {String} json '{name: "Donnys", age: 28}'
     */
    util.decode = function(json) {
        return eval("(" + json + ")");
    };

    /**
     * Get DOM Element By ID
     * @param ElementID
     */
    util.getElement = function(eid) {
        return document.getElementById(eid);
    };
})(comnovo);

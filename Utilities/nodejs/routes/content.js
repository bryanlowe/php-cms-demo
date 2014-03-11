/* The ContentHandler must be constructed with a connected db */
function ContentHandler (db) {
    "use strict";

    this.displayMainPage = function(req, res, next) {
        "use strict";
        return res.render('index');
    }
}

module.exports = ContentHandler;
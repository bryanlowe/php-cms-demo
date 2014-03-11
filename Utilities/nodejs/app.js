var express = require('express'),
	app = express(), // Web framework to handle routing requests
	cons = require('consolidate'), // Templating library adapter for Express
	mongoose = require('mongoose'), // Framework for building MongoDB Schema
	routes = require('./routes'); // Routes for our application;

mongoose.connect('mongodb://localhost/cms_test', function(err, db){
	if(err) throw err;

	// Register our templating engine
    app.engine('html', cons.swig);
    app.set('view engine', 'html');
    app.set('views', __dirname + '/views');

    // Express middleware to populate 'req.cookies' so we can access cookies
    app.use(express.cookieParser());

    // Express middleware to populate 'req.body' so we can access POST variables
    app.use(express.bodyParser());

    // Application routes
    routes(app, db);

    app.listen(3000);
    console.log('Express server listening on port 3000');
});

// in order to run this app and keep it persistent type the following:
// forever start -c nodemon -w app.js
var mqtt    = require('mqtt');
var mqttclient  = mqtt.connect('mqtt://localhost');
var macid ='18:fe:34:9b:74:55';
mqttclient.on('connect', function () {
  mqttclient.subscribe('esp/'+macid+'/battery');
});


mqttclient.on('message', function (topic, message) {
  // message is Buffer 
  console.log(message.toString());
	var batVol=0;
 	
	batVol=message;

	var ThingSpeakClient = require('thingspeakclient');
	var tsclient = new ThingSpeakClient({server:'http://localhost:3000'});
	
	
	tsclient.attachChannel(2, {writeKey:'M77V4SCP95AB1UEX'});
	
	tsclient.updateChannel(2, {field2: batVol.toString()}, function(err, resp) {
		if (!err && resp > 0) {
		    console.log('update successfully. Entry number was: ' + resp);
		}
	});
	data=1-data;
	mqttclient.publish('esp/'+macid, data.toString(),{qa:1,retain:true});
	console.log("Now the valve is "+data.toString());
	//mqttclient.end();
  });


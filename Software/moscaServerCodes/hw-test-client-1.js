var mqtt    = require('mqtt');
var client  = mqtt.connect('mqtt://localhost');
var macid = '18:fe:34:9b:74:55';
data = process.argv[2];
client.on('connect', function () {
  client.subscribe('esp/'+macid);
  client.publish('esp/'+macid, data.toString(),{qa:1,retain:true});
});
 
client.on('message', function (topic, message) {
  // message is Buffer 
  console.log(message.toString());
  client.end();
});

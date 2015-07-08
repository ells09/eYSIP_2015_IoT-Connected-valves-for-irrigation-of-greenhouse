/*$(document).ready(function(){


  

	$( '#navigation li' ).hover(function(){
		$( this )
			.stop( true )
			.animate(
				{height: '40px'},
				{duration: 600, easing: 'easeOutBounce'}
			)
	},function(){
		$( this )
			.stop( true )
			.animate(
				{height:'20px'},
				{duration:600, easing: 'easeOutCirc'}
			)
	});

  
 });*///ending document ready

 function checkInputs() {    //validation form
		var name = document.getElementById("answerkey").value;
       var image = document.getElementById("Photo").value;
    if (name != "" && image != "") {
    return true;
    } else {
    alert("Not all the fields has been filled in!");
    return false;
    }
    }
 function positionFooter() { var mFoo = $("#myfooter"); if ((($(document.body).height() + mFoo.height()) < $(window).height() && mFoo.css("position") == "fixed") || ($(document.body).height() < $(window).height() && mFoo.css("position") != "fixed")) { mFoo.css({ position: "fixed", bottom: "0px" }); } else { mFoo.css({ position: "static" }); } } $(document).ready(function () { positionFooter(); $(window).scroll(positionFooter); $(window).resize(positionFooter); $(window).load(positionFooter); });

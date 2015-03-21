
var htmlId = function(id){return document.getElementById(id)};

var canvas = new fabric.Canvas('covermaker-canvas',{backgroundColor: '#FFF'});

$('#bgcolor').ColorPicker({
			color: '#ffffff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				 canvas.backgroundColor = '#' + hex;
				 canvas.renderAll();
			}
		});
		
$('#text-color').ColorPicker({
			color: '#ffffff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				var activeObject = canvas.getActiveObject();
				if (activeObject && activeObject.type == 'text') {
					activeObject.set('fill', '#' + hex);
					canvas.renderAll();
				}
			}
		});

htmlId('underline').onclick = function() {
	var activeObject = canvas.getActiveObject();
	if (activeObject && activeObject.type == 'text')
	{
		activeObject.textDecoration = (activeObject.textDecoration == 'underline' ? '' : 'underline');
		canvas.renderAll();
	}
};

htmlId('italic').onclick = function() {
	var activeObject = canvas.getActiveObject();
	if (activeObject && activeObject.type == 'text')
	{
		activeObject.fontStyle = (activeObject.fontStyle == 'italic' ? '' : 'italic');
		canvas.renderAll();
	}
};

htmlId('shadow').onclick = function() {
	var activeObject = canvas.getActiveObject();
	if (activeObject && activeObject.type == 'text')
	{
		activeObject.textShadow = !activeObject.textShadow ? 'rgba(0,0,0,0.5) 6px 6px 10px' : '';
		canvas.renderAll();
	}
};

$('#font').change(function(){
	 canvas.getActiveObject().fontFamily = ($(this).val());
	 canvas.renderAll();
	});

$('#add_rect').click(function(){
	canvas.add(new fabric.Circle({ radius: 20, fill: '#f55', top: 170, left: 150 }));
	});
	
$('#removeall').click(function(){
	canvas.clear();
	canvas.setBackgroundImage('', function() { 
			canvas.renderAll(); 
		});
	});
	
$('#flip-horizontal').click(function(){
	horizontal();
	});
	
$('#flip-vertical').click(function(){
	vertical();
	});

$('#back').click(function(){
	var currentObject = canvas.getActiveObject();
	canvas.sendBackwards(currentObject);
	});

$('#front').click(function(){
	var currentObject = canvas.getActiveObject();
	canvas.bringForward(currentObject);
	});
	
$("#controlSL ul li").click(function(){
	if ($(this).attr('id')=='clearframe') {
		canvas.setBackgroundImage('', function() { 
			canvas.renderAll(); 
		});
	}
	else {
		$('#controlSR span').css({'display':'none'});
		$('#'+$(this).attr('id')+'_carousel').css({'display':''});
	}
});
	

	
/ * FILTERS START */
function applyFilter(index, filter) {
  var obj = canvas.getActiveObject();
  obj.filters[index] = filter;
  obj.applyFilters(canvas.renderAll.bind(canvas));
}

f = fabric.Image.filters;

$("#grayscale_btn").click(function () { $("#grayscale").click().change(); });

$('#grayscale').change(function(){
	  applyFilter(0, this.checked && new fabric.Image.filters.Grayscale());
});

$("#invert_btn").click(function () { $("#invert").click().change(); });

$('#invert').change(function(){
	  applyFilter(0, this.checked && new fabric.Image.filters.Invert());
});

$("#sepia_btn").click(function () { $("#sepia").click().change(); });

$('#sepia').change(function(){
	  applyFilter(0, this.checked && new fabric.Image.filters.Sepia());
});

/ * FILTERS END */

function horizontal(){
if (canvas.getActiveObject().flipX==true){canvas.getActiveObject().flipX=false;canvas.renderAll()}
else {canvas.getActiveObject().flipX=true ;canvas.renderAll();}
}

function vertical(){
if (canvas.getActiveObject().flipY==true){canvas.getActiveObject().flipY=false;canvas.renderAll()}
else {canvas.getActiveObject().flipY=true ;canvas.renderAll();}
}
///////////////////////
document.onkeydown = function(e) {
    var obj = canvas.getActiveObject() || canvas.getActiveGroup();
    if (obj && e.keyCode === 8) {
      // this is horrible. need to fix, so that unified interface can be used
      if (obj.type === 'group') {
        // var groupObjects = obj.getObjects();
        //         canvas.discardActiveGroup();
        //         groupObjects.forEach(function(obj) {
        //           canvas.remove(obj);
        //         });
      }
      else {
        //canvas.remove(obj);
      }
      canvas.renderAll();
      // return false;
    }
  };
///////////////////


	  
/* Text Start */
var text = 'Enter Text';
  document.getElementById('add-text').onclick = function() {
    var textSample = new fabric.Text(text.slice(0,100), {
      fontFamily: 'Arial', 
	  left: 400,
	  top: 225,
	  fontSize: 80,
	  textAlign: "left",
	  fill:"#FF0000"  // Set text color to red
    });
    canvas.add(textSample);
  };



var textEl = document.getElementById('text-input');
  if (textEl) {
    textEl.onfocus = function() {
      var activeObject = canvas.getActiveObject();

      if (activeObject && activeObject.type === 'text') {
        this.value = activeObject.text;
      }
    };
    textEl.onkeyup = function(e) {
      var activeObject = canvas.getActiveObject();
      if (activeObject) {
        if (!this.value) {
          canvas.discardActiveObject();
        }
        else {
          activeObject.text = this.value;
        }
        canvas.renderAll();
      }
    };
  }

var removeSelectedEl = document.getElementById('remove-selected');
  removeSelectedEl.onclick = function() {
    var activeObject = canvas.getActiveObject(),
        activeGroup = canvas.getActiveGroup();
    if (activeObject) {
      canvas.remove(activeObject);
    }
    else if (activeGroup) {
      var objectsInGroup = activeGroup.getObjects();
      canvas.discardActiveGroup();
      objectsInGroup.forEach(function(object) {
        canvas.remove(object);
      });
    }
  };

// TEXT END

/*fabric.Image.fromURL('images/user_pic.png', function(img) {
  var oImg = img.set({ left: 110, top: 75, angle: 10 }).scale(0.7);
  canvas.add(oImg).renderAll();

});*/
//upload menu image and set as canvas BG
	function handleMenuImage(e){
		var reader = new FileReader();
		reader.onload = function(event){
			var img = new Image();
			img.src = event.target.result;
			//alert('width1 '+img.width);
			img.onload = function() {
				//alert(img.src);
				//alert('width2 '+img.width);
				/*canvas.setWidth(img.width);
				canvas.setHeight(img.height);*/
				//canvas.setBackgroundImage(img.src, canvas.renderAll.bind(canvas));
				
				fabric.Image.fromURL(img.src, function(img) {
				  var oImg = img.set({  angle: 0 }).scale(0.7).scaleToWidth(400);
				  canvas.add(oImg).renderAll();
				  canvas.centerObject(oImg);
				});
		
				//set the page background
				/*menuPages[currentPage].pageBackground.src = img.src;
				canvas.backgroundImageStretch = false;*/
			}
		}
		reader.readAsDataURL(e.target.files[0]); 
	}
	

	var menuImageLoader = document.getElementById('imageLoader');
	menuImageLoader.addEventListener('change', handleMenuImage, false);
	

// Apply template image to background
function applyTemplate(e) {
	var templatefilename = e.src.replace(/^.*[\\\/]/, '');
	canvas.setBackgroundImage('/images/cover/'+templatefilename, function() { 
		canvas.renderAll(); 
	});
}

// Event : selected
canvas.observe('object:selected', function(e) {
	var activeObject = e.target;
	// Keep ratio
	currentScaleX = activeObject.get('scaleX');
	currentScaleY = activeObject.get('scaleY');
	if (activeObject && activeObject.type == 'text')
	{	
		$('#text-input').removeAttr('disabled');
		$('#font').removeAttr('disabled');
		$('#font').val(activeObject.fontFamily);
		// Set proper text to user input
		htmlId('text-input').value = activeObject.getText();
		// Remove placeholder class when text is selected
		$('[thisplaceholder]').removeClass('placeholder');
		setFontStyle();
		resetFilters();
		
	}
	else if (activeObject && activeObject.type != 'text') {
		htmlId('text-input').value = '';
		// Reset font style buttons
		$('#text-input').attr('disabled','disabled');
		$('#font').attr('disabled','disabled');
		resetFontStyle();
		resetObjectStyle();
		setFilters();
	}
	setObjectStyle();
});

canvas.observe('selection:cleared', function(e) {
	$('#text-input').attr('disabled','disabled');
	$('#font').attr('disabled','disabled');
	resetFontStyle();
	resetObjectStyle();
});

// Set / Resets objects

function setObjectStyle()
{
	$('#flip-horizontal').removeClass('disabled');
	$('#flip-vertical').removeClass('disabled');
	$('#back').removeClass('disabled');
	$('#front').removeClass('disabled');
	$('#remove-selected').removeClass('disabled');
}
function setFontStyle()
{
	$('#text-color').removeClass('disabled');
	$('#underline').removeClass('disabled');
	$('#italic').removeClass('disabled');
	$('#shadow').removeClass('disabled');
}

function resetObjectStyle()
{
	$('#flip-horizontal').addClass('disabled');
	$('#flip-vertical').addClass('disabled');
	$('#back').addClass('disabled');
	$('#front').addClass('disabled');
	$('#remove-selected').addClass('disabled');

}
function resetFontStyle()
{
	$('#text-color').addClass('disabled');
	$('#underline').addClass('disabled');
	$('#italic').addClass('disabled');
	$('#shadow').addClass('disabled');
}

function setFilters()
{
	$('#grayscale_btn').removeClass('disabled');
	$('#invert_btn').removeClass('disabled');
	$('#sepia_btn').removeClass('disabled');
}
function resetFilters()
{
	$('#grayscale_btn').addClass('disabled');
	$('#invert_btn').addClass('disabled');
	$('#sepia_btn').addClass('disabled');
}

canvas.renderAll();

$('#save').click(function(){
	canvas.deactivateAll().renderAll();
	$('#save').attr('value', 'Please wait...','disabled', 'disabled');
	saveViaAJAX('0');
	});

$('#save_profile').click(function(){
	canvas.deactivateAll().renderAll();
	$('#save_profile').attr('value', 'Please wait...','disabled', 'disabled');
	saveViaAJAX('1');
	});
	
function saveViaAJAX(a)
{
	
	if( document.getElementById("covermaker-canvas") == '[object HTMLImageElement]')
	{
		//alert('a');
		//document.apple.submit();
	}
	else
	{
		var testCanvas = document.getElementById("covermaker-canvas");
		var canvasData = testCanvas.toDataURL("image/jpeg");
		var postData = "canvasData="+canvasData;
		/*var debugConsole= document.getElementById("debugConsole");
		debugConsole.value=canvasData;*/
	
		//alert("canvasData ="+canvasData );
		var ajax = new XMLHttpRequest();
		
		if(a == 1)
		{
			ajax.open("POST",BASE_URI+'create/createimage/1',true);
		}
		else
		{
			ajax.open("POST",BASE_URI+'create/createimage/0',true);
		}
		ajax.setRequestHeader('Content-Type', 'application/upload');
		//ajax.setRequestHeader('Content-TypeLength', postData.length);
	}

	ajax.onreadystatechange=function()
  	{
		if (ajax.readyState == 4)
		{
			//alert(ajax.responseText);
			window.location.href = ajax.responseText;
			//document.apple.submit();
		}
		else
		{
			//alert('not done');
		}
  	}

	ajax.send(postData);
}

// Apply template image to background
function applyTemplate(e) {
	var templatefilename = e.src.replace(/^.*[\\\/]/, '');
	canvas.setBackgroundImage(BASE_URI+'covers-images/assets/'+templatefilename, function() { 
		canvas.renderAll(); 
	});
}

// Add object to canvas
function addObject(e) {
	
	var templatefilename = e.src.replace(/^.*[\\\/]/, '');
	var org_url = BASE_URI+'covers-images/assets/'+templatefilename;
		fabric.Image.fromURL(org_url, function(img) {
		img.MIN_SCALE_LIMIT = 1;
		canvas.add(img.set({ left: 400 - fabric.util.getRandomInt(0, 200), top: 100 - fabric.util.getRandomInt(0, 40) }).scale(0.5));
		//if (profilepicture) canvas.bringToFront(profilepicture);
		canvas.calcOffset();
		canvas.renderAll();
	});
}

// Add friend to canvas
function addFriend(e) {
	
	var templatefilename = e.id;
	var org_url = 'https://graph.facebook.com/'+templatefilename+'/picture?width=200&height=200';
		fabric.Image.fromURL(org_url, function(img) {
		img.MIN_SCALE_LIMIT = 1;
		canvas.add(img.set({ left: 400 - fabric.util.getRandomInt(0, 200), top: 100 - fabric.util.getRandomInt(0, 40) }).scale(0.5));
		//if (profilepicture) canvas.bringToFront(profilepicture);
		canvas.calcOffset();
		canvas.renderAll();
	});
}
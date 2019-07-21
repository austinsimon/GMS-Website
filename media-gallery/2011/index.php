<?php
//GoodGallery 1.3.unreleased by Cory Salvesen -- This is a beta/test version
//Terms of use:
//You may use this script on your website as long as my link is clear and visible at the bottom.
//Please leave my link at the bottom, it helps spread my script

//copyright Cory Salvesen 2014

//----------------------------------General Settings-----------------------------------------------------------

//The title for this gallery to be displayed in the browser's title bar
$customtitle = "2011";

//How many thumbnails to display per page. (you may set a very large number to just display all thumbs on one page e.g. 9999)
$thumbsperpage = 50;

//Sorts the gallery alphabetically (if false, the gallery will be sorted by the filesystem default)
$sortalpha = true;

//Reverses the sort order of the pictures
$reversesort = false;

//Maximum image build requests to push to the server simultanously. On a powerful server with lots of RAM and multiple cpu cores, increasing this can greatly improve
//build performance (Warning: increasing this could violate your hosting provider's CPU usage limits)
$xhrpush = 1;

//The password for administration of the gallery.  If this is set to "default", it will completely disable admin access.
//note: to enter admin mode, click "generated" at the bottom of the page.  This will only work if a password is set here:
$password = "default" ;

//if you edit the settings below this point on an existing gallery, you should delete /previewcache and /thumbcache
//-------------------------------------File Settings-----------------------------------------------------------

//Largest dimension allowed in preview images, anything larger will be resized. ie max height OR width
$maxdimension = 800;

//quality of preview images 0-100, 100 being largest filesize, but best quality)
$previewquality = 85;

//Largest dimension allowed in thumbnail images, anything larger will be resized. ie max height OR width
$maxthumbdimension = 80;

//quality of thumbnail images 0-100, 100 being largest filesize, but best quality)
$thumbquality = 95;

// Do not edit below this point unless you know what you're doing--and even then you probably shouldn't
//---------------------------------------------------------------------------------------------------------------------------

function lastimagevalue()
{
	global $filearray ;
	$i = 0;
	if(count($filearray) == 0)
		return 0;
	foreach($filearray as $currentfile){
		$i++;
	}
return $i;
}

function findtype($filename)
{
	return strtoupper(array_pop(explode(".", $filename)));
}

function htmltop()
{
	global $customtitle;
  echo '<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<link rel="stylesheet" href="http://gatormotorsports.com/framework/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
			<link href="https://fonts.googleapis.com/css?family=Exo:600|Open+Sans" rel="stylesheet">
			<link rel="stylesheet" href="http://gatormotorsports.com/css/main.css">';
	  echo '<title>Gator Motorsports - Media</title>
			<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
			<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
			<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
			<meta name="msapplication-TileColor" content="#da532c">
			<meta name="theme-color" content="#ffffff">';
  echo '</head>';

echo '<body onkeyup="unlockkeys(event)" onkeydown="keycheck(event)" onload="startjs()">';
  echo '<div class="social-media-menu">
		<div class="container">
			<ul>
				<li><a href="https://www.facebook.com/gatormotorsports"><i class="fab fa-facebook-square"></i></a></li>
				<li><a href="https://www.instagram.com/gator.motorsports/"><i class="fab fa-instagram"></i></a></li>
				<li><a href="mailto:uffsae@gmail.com"><i class="fas fa-envelope"></i></a></li>
			</ul>
		</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark nav-alt" id="navbar">
		<div class="nav-container">
			<a class="navbar-brand" href="http://gatormotorsports.com/index.html">
				<img src="http://gatormotorsports.com/img/logo.png" class="logo" alt="">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="http://gatormotorsports.com/about.html">ABOUT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="http://gatormotorsports.com/media.html">MEDIA</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="http://gatormotorsports.com/sponsors.html">SPONSORS</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="http://gatormotorsports.com/join.html">JOIN</a>
					</li>
				</ul>
			</div>
		</div>
		</nav>

		<div class="page-content-norm">

		<div class="page-intro media-intro">
		<div class="page-title">
			<h1>MEDIA</h1>   
		</div>
		</div>

		<div class="container">
		<div class="content-p">
		<div class="row">
		<div class="col">
		<h2 class="text-center">' . $customtitle . ' Photo Album</h2></div></div>
		<div class="row"><div class="col">';
}

function htmlbottom()
{
echo '</div>
	  </div>
	  </div>
	  </div>
        <footer>
            <div class="content-p">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h6>Mailing Address</h6>
                            <p>Attn: Gator Motorsports</p>
                            <p>237 MAE-B</p>
                            <p>University of Florida</p>
                            <p>Gainesville, Florida 32611</p>
                        </div>
                        <div class="col">
                            <h6>Shipping Address</h6>
                            <p>Attn: Gator Motorsports</p>
                            <p>133-134 MAE-C</p>
                            <p>University of Florida</p>
                            <p>Gainesville, Florida 32611</p>
                        </div>
                        <div class="col">
                            <h6>Contact</h6>
                            <p>Phone: <a href="tel:5614278468">(561) 427-8468</a></p>
                            <p>Fax: (352) 392-1071</p>
                            <p>Email: <a href="mailto:uffsae@gmail.com">uffsae@gmail.com</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <hr>
                            <p class="copyright">Copyright © Gator Motorsports 2018</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
</div>';
}

function styles()
{
global $cssexists;
if($cssexists) {
echo '	<link rel="stylesheet" type="text/css" href="goodgallery.css" />';
}else
{
//Do not edit styles here, use goodgallery.css
echo '
<!-- If you are reading this, it means that goodgallery has reverted to the default stylesheet -->
<!-- This is fine, but you can also create your own stylesheet named "goodgallery.css", put it in the same directory -->
<!-- as goodgallery and that will completely replace the default stylesheet -->
<style type="text/css">
body
{
color: #999;
background-color: black;
font-family: arial, helvetica, verdana, tahoma, sans-serif;
font-size: 1.0em;
line-height: 1.0em;
}
a:link, a:visited
{
color: #bbb;
text-decoration: underline;
}
a:hover
{
color: #bbb;
text-decoration: underline;
}
img
{
border: 0;
}
hr
{
color: #666666;
}
#thumbs ul
{
list-style-type:none;
text-align:center;
margin:0 auto;
width:90%;
}
#thumbs
{
text-align:center;
}
#thumbs a
{
background-color: #000;
display: inline-block;
}
#thumbs img
{
vertical-align: middle;
padding: 2px;
}
#thumbs a:hover img
{
filter:alpha(opacity=90);   
-moz-opacity: .9;
opacity: .9;
}
#preloader
{
display:none;
}
#prevnext
{
text-align:center;
}
#prevnext button
{
color:#bbb;
width:60px;
height:25px;
background-color:#000;
border-style:solid;
border-color:#bbb;
border-width:1px;
text-transform: uppercase;
}
#prevnext button:hover
{
color:#000;
background-color:#fff;
border-style:solid;
border-color:#000;
border-width:1px;
}
#photospot
{
cursor:pointer;
}
#photodiv
{
text-align:center;
}
#counter
{
text-align:center;
}
#bottomlink
{
text-align:center;
}
button
{
cursor: pointer;
}
</style>
'; //Do not edit styles here, use goodgallery.css
} //else end

} //function end

function opendiv($divid)
{
echo '<div id="' . $divid . '">';
}

function closediv()
{
echo '</div>';
}

function findvaluebyfilename($filename) //finds image value by filename for use in permalinks returns 0 if file doesnt exist.
{
	global $filearray ;
	$i = 1;
	foreach($filearray as $currentfile)
	{
		if($currentfile == $filename)
			return $i;
		$i++;
	}
	return 0;
}

function fastdisplayimage()
{
	global $lastimagevalue;	
	global $filearray;
	global $thumbsperpage;
	global $xhrpush;
	global $password;
	$selfurl = $_SERVER["PHP_SELF"] ;
	
	if(isset($_POST['logout']))
	{
		session_destroy();
		echo "logged out<br/>";
		echo "<a href='" . $selfurl . "' >Return to gallery</a><br/><br/>";
		return 1;
	}

	if(isset($_POST['password']))
	{
		sleep(1); // extremely effective method of stopping brute force password searches.
		if($_POST['password'] === $password && !($password === "default"))
			$_SESSION['admin'] = $password;
	}
	
	$isadmin = 0;
	if(isset($_SESSION['admin']) && $_SESSION['admin'] === $password)
		$isadmin = 1;
	if($password === "default")
		$isadmin = 3;


	echo '
	<script type="text/javascript">
		<!--
		var images = [];
		var previewimages = [];
		var thumbs = [];
		var thumbpage = [];
		var lastimagevalue;
		var lastpagevalue = 1;
		var monitortimerid;
		var hashmirror;
		var isMSIE;
		';
	echo "lastimagevalue = $lastimagevalue ;
	";

	for($i=1;$i<=($lastimagevalue);$i++)
	{
	echo "images[$i] = " . '"' . $filearray[$i-1] . '";
	';
	}
		
	$thumburl = $_SERVER["PHP_SELF"] . "?page=1";

	//large javascript/html block
	// this cool method lets me use ' and " and interpolated variables at the same time
	echo <<<END

	var inum = 1;
	var pnum = 1;
	var isfullres = 0;
	var keyslocked = 0;
	var waitingfor = 0;
	var xhrqueue = 0;
	function unlockkeys(e)
	{
		keyslocked = 0;	
	}
	function keycheck(e)
	{
		if(keyslocked==0)
		{
			if(((e.which == 37)||(e.keyCode == 37))&&(isfullres==0))
				leftbutton();
			else if(((e.which == 39)||(e.keyCode == 39))&&(isfullres==0))
					rightbutton();
				 else if((e.which == 13) || (e.keyCode == 13))
						   togglefullres();
			keyslocked = 1;	
		}
	}

var fnWhenDone = function (oXML)
{
		xhrqueue -= 1;
		waitingfor -= 1;
		realtime1 = document.getElementById("realtime");
		if(images[oXML.responseText] != null)
			realtime1.innerHTML = "realtime monitor: " + images[oXML.responseText] + " added to gallery.<br/>Still waiting for " + waitingfor + " requests.";
		else
		{
			if(oXML.responseText == "")
				realtime1.innerHTML = "realtime monitor: The server did not respond.  GoodGallery will continue to try to contact the server.<br/>This message will go away once the connection is reestablished.";
			else
				realtime1.innerHTML = "realtime monitor: The server responded: " + oXML.responseText ;
		}
		currentpic = document.getElementById(oXML.responseText);
		if(currentpic != null)
			currentpic.src += "#";
		if(monitortimerid != null)
			clearTimeout(monitortimerid);
		monitortimerid = setTimeout("clearmonitor()", 5000);
};
function clearmonitor()
{
	if(waitingfor <= 0)
	{
		realtime1 = document.getElementById("realtime");
		realtime1.innerHTML = "" ;
		requestbuildall();
	}
}
function finalclearmonitor()
{
		realtime1 = document.getElementById("realtime");
		realtime1.innerHTML = "" ;
}
function requestbuildall()
{
		realtime1 = document.getElementById("realtime");
		realtime1.innerHTML = "<h2>Validating gallery, please wait...</h2>";
		var url = "buildall=1&nocache=" + Math.random() ;
		var xhr = new XHConn();
		xhr.connect("$selfurl", "GET", url, aftervalidate);
}
function aftervalidate(oXML)
{
	realtime1 = document.getElementById("realtime");
	realtime1.innerHTML = "";
	temp = oXML.responseText;
	temp += "";
	if(temp.indexOf("Allowed memory size") != -1)
	{
		temp = "GoodGallery Fatal Error: an image caused out of memory error.<br/><br/>";
		temp += "An image is probably too large (dimension wise) to be built within the limits of your PHP configuration<br/>";
		temp += "Your options are as follows:<br/><br/>";
		temp += "1. increase your php memory_limit.  Check out resource limits on <a href='http://php.net/ini.core'>http://php.net/ini.core</a><br/>";
		temp += "256M is usually a good value, but you can choose whatever you need.<br/>";
		temp += "If you don't have access to this, call your hosting provider.<br/><br/>";
		temp += "2. remove images that are too large from the gallery.<br/>(Sorry I can't figure out which images are causing the problem, it's probably whichever ones have the most pixels ie height*width)<br/>";
		realtime1.innerHTML = temp;
	return 1;
	}
	if(oXML.responseText[oXML.responseText.length-1] == "1")
	{
		realtime1.innerHTML = "<h2>Gallery is 100% built and validated. (this message will clear)</h2>";
		setTimeout("location.reload();", 2000);
		if(monitortimerid != null)
			clearTimeout(monitortimerid);
		monitortimerid = setTimeout("finalclearmonitor()", 10000);
	}
	else
		requestbuildall();
}
/** XHConn - Simple XMLHTTP Interface - bfults@gmail.com - 2005-04-08        **
 ** Code licensed under Creative Commons Attribution-ShareAlike License      **
 ** http://creativecommons.org/licenses/by-sa/2.0/                           **/
function XHConn()
{
  var xmlhttp, bComplete = false;
  try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); }
  catch (e) { try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }
  catch (e) { try { xmlhttp = new XMLHttpRequest(); }
  catch (e) { xmlhttp = false; }}}
  if (!xmlhttp) return null;
  this.connect = function(sURL, sMethod, sVars, fnDone)
  {
    if (!xmlhttp) return false;
    bComplete = false;
    sMethod = sMethod.toUpperCase();

    try {
      if (sMethod == "GET")
      {
        xmlhttp.open(sMethod, sURL+"?"+sVars, true);
        sVars = "";
      }
      else
      {
        xmlhttp.open(sMethod, sURL, true);
        xmlhttp.setRequestHeader("Method", "POST "+sURL+" HTTP/1.1");
        xmlhttp.setRequestHeader("Content-Type",
          "application/x-www-form-urlencoded");
      }
      xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState == 4 && !bComplete)
        {
          bComplete = true;
          fnDone(xmlhttp);
        }};
      xmlhttp.send(sVars);
    }
    catch(z) { return false; }
    return true;
  };
  return this;
}

	function nextIndex(i)
	{
		if(i == lastimagevalue)
			return 1;
		else
			return i + 1;
	}
	function prevIndex(i)
	{
		if(i == 1)
			return lastimagevalue;
		else
			return i - 1;
	}

	function nextimage()
	{
		inum = nextIndex(inum);
		startimage();
	}
	function previousimage()
	{
		inum = prevIndex(inum);
		startimage();
	}
	function previouspage()
	{
	if(pnum <=1 )
		pnum = lastpagevalue;
	else
		pnum = pnum - 1;
	displaythumbs();
	}
	function nextpage()
	{
		if(pnum >= lastpagevalue)
			pnum = 1;
		else
			pnum = (pnum*1) + 1;
		displaythumbs();
	}
	function requestbuild(filenumber)
	{
		waitingfor += 1;
		realtime1 = document.getElementById("realtime");
		realtime1.innerHTML = "realtime monitor: Adding new photos to gallery, Please wait...<br/>Still waiting for " + waitingfor + " requests." ;
		filename = images[filenumber];
		var url = "build=" + escape(filename) + "&nocache=" + Math.random() + "&inum=" + filenumber;
		rawrequestbuild(url);
	}

	function whendonebasic(oXML)
	{
		realtime1 = document.getElementById("realtime");
		if(oXML.responseText != "")
			realtime1.innerHTML = "realtime monitor: " + oXML.responseText ;
	
		if(monitortimerid != null)
			clearTimeout(monitortimerid);
		monitortimerid = setTimeout("finalclearmonitor()", 9000);
	}
	
	function clearcache()
	{
		var url = "clearcache&nocache=" + Math.random() ;
		var xhr = new XHConn();
		xhr.connect("$selfurl", "GET", url, whendonebasic);

	}



	function rawrequestbuild(url)
	{
		if(xhrqueue >= $xhrpush)
		{
			temp = "rawrequestbuild('" + url + "')";
			setTimeout(temp, 250);
		return 0;
		}
		xhrqueue += 1;
		var xhr = new XHConn();
		xhr.connect("$selfurl", "GET", url, fnWhenDone);
	}
	
	function startjs()
	{
		isMSIE = ((navigator.appName == "Opera") || (navigator.appName == "Microsoft Internet Explorer" && parseFloat(navigator.appVersion) == 4));
		setInterval("watchhash()", 200);
		hashmirror = location.hash.slice(1);
		startwiththumbs = 1;
		for(i=1;i<=lastimagevalue;i++)
		{
			previewimages[i] = "previewcache/" + images[i] + ".resized.jpg";
			thumbs[i] = "thumbcache/" + images[i] + ".resized.jpg";
			if(unescape(location.hash.slice(1)) == images[i])
			{
				inum = i;
				startwiththumbs = 0;
			}
		}
		buildthumbpages();

		if(startwiththumbs == 1)
		{
			if(location.hash.slice(2) <= lastpagevalue && location.hash.slice(2) >=1)
				pnum = location.hash.slice(2);
			displaythumbs();
		}
		else
			startimage();
	}
	function watchhash()
	{
		if(isMSIE)
			return 1;
		if(unescape(location.hash.slice(1)) != unescape(hashmirror))
			refreshfromhash();
	}

	function refreshfromhash()
	{
		hashmirror = location.hash.slice(1);
		if(hashmirror.charAt(0) == ":" )
		{
			if(location.hash.slice(2) <= lastpagevalue && location.hash.slice(2) >=1)
				pnum = location.hash.slice(2);
			else
				pnum = 1;
			displaythumbs();
		}
		else
		{
			for(i=1;i<=lastimagevalue;i++)
			{
				if(unescape(location.hash.slice(1)) == images[i])
					inum = i;
			}
			startimage();
		}
	}

	function movetotrash()
	{
		var url = "movetotrash=" + escape(images[inum]) + "&nocache=" + Math.random() ;
		var xhr = new XHConn();
		xhr.connect("$selfurl", "GET", url, whendonebasic);	
		rightbutton();
	}

	function startimage()
	{
		if($isadmin == 1)
		{
			aspot = document.getElementById("adminnotify");
			aspot.innerHTML = "Administrator mode. <button onmouseup='movetotrash()'>Move to trash</button><br/>";
		}
		place = document.getElementById("thumbs") ;
		place.innerHTML = "";
		isfullres = 0;
		x = document.getElementById("photospot");
		y = document.getElementById("preimages");
		z = document.getElementById("counter");	

		hashmirror = escape(images[inum]);
		location.hash = hashmirror;

		pnum = Math.ceil(inum / $thumbsperpage);

		x.innerHTML = "<img src=" + escape(previewimages[inum]) + " onerror='requestbuild("+ inum +")'" + " id='" + inum + "' alt='["+ images[inum]+ "]'></img>";
		y.innerHTML = "<img src=" + escape(previewimages[nextIndex(inum)]) + "></img>";
		y.innerHTML += "<img src=" + escape(previewimages[prevIndex(inum)]) + "></img>";
		z.innerHTML = inum + " of " + lastimagevalue + " - ";
		z.innerHTML += images[inum];
	}
	function fullres()
	{
			x = document.getElementById("photospot");
			x.innerHTML = "<img src=" + escape(images[inum]) + "></img>";	
	}
	function togglefullres()
	{
		if(location.hash.slice(1).charAt(0) == ":")
			return true;
		if(isfullres == 0)
		{	
			isfullres = 1;
			fullres();
		}
		else
		{
			startimage();
		}
	}
	function preview(imageindex)
	{
		inum = imageindex ;
		startimage();
	}

	function buildthumbpages()
	{
		lastpagevalue = Math.ceil(lastimagevalue / $thumbsperpage);
		currentpage = 1;
		countonpage = 0;
		for(i=1;i<=lastimagevalue;i++)
		{
			if(countonpage == 0)
			{
				thumbpage[currentpage] = "";
				if(lastpagevalue > 1)
					thumbpage[currentpage] += "Page " + currentpage + " of " + lastpagevalue 
				thumbpage[currentpage] += "<br/>" + "<ul>";
			}
			
			countonpage += 1;


			thumbpage[currentpage] += "<a href=#" + escape(images[i]) + " onclick='preview(" + i + ");return false;'" + ">";
			thumbpage[currentpage] += "<img src=" + escape(thumbs[i]) + " onerror='requestbuild(" + i + ")'" + " id='" + i + "' alt='[" + images[i] + "]'></img>";
			thumbpage[currentpage] += "</a>";

			if(countonpage == $thumbsperpage)
			{
				thumbpage[currentpage] += "</ul>";
				currentpage += 1;
				countonpage = 0;
			}
			else
				if(i == lastimagevalue)
				{
					thumbpage[currentpage] += "</ul>";
				}
		}
	}

	function leftbutton()
	{
		if(unescape(location.hash.slice(1)).charAt(0) == ":" )
			previouspage();
		else
			previousimage();
	}

	function rightbutton()
	{
		if(unescape(location.hash.slice(1)).charAt(0) == ":" )
			nextpage();
		else
			nextimage();
	}
	function exploretrash()
	{
		place = document.getElementById("thumbs") ;
		place.innerHTML = "loading";
		var url = "exploretrash&nocache=" + Math.random() ;
		var xhr = new XHConn();
		xhr.connect("$selfurl", "GET", url, afterexploretrash);
	}
	function restorefile(currentfile)
	{
		var url = "restorefile=" + escape(currentfile) + "&nocache=" + Math.random() ;
		var xhr = new XHConn();
		xhr.connect("$selfurl", "GET", url, whendonebasic);	
	}
	function restoreall()
	{
		var url = "restoreall" + "&nocache=" + Math.random() ;
		var xhr = new XHConn();
		xhr.connect("$selfurl", "GET", url, whendonebasic);	
	}
	function emptytrash()
	{
		var url = "emptytrash" + "&nocache=" + Math.random() ;
		var xhr = new XHConn();
		xhr.connect("$selfurl", "GET", url, whendonebasic);	
	}
	function deletefile(currentfile)
	{
		var url = "deletefile=" + escape(currentfile) + "&nocache=" + Math.random() ;
		var xhr = new XHConn();
		xhr.connect("$selfurl", "GET", url, whendonebasic);	
	}
	function afterexploretrash(oXML)
	{
		place = document.getElementById("thumbs") ;

		if(oXML.responseText != "")
			place.innerHTML = oXML.responseText ;
	}

	function displaylogin()
	{
		if($isadmin == 3)
			return 1;
		x = document.getElementById("login");
		temp = '<form action="$selfurl"' + '?login' + ' method="post">';
		if($isadmin == 1)
		{
			temp += '<input type="submit" name="logout" value="logout" /></form><br/>';
			x.innerHTML = temp;
			return 1;
		}
		temp += 'Administrator login: <input id="pwbox" type="password" name="password" /></form><br/>';
		x.innerHTML = temp;
		y = document.getElementById("pwbox");
		y.focus();
	}

	function displaythumbs()
	{
		if(isfullres == 1)
			togglefullres();
		if($isadmin == 1)
		{
			aspot = document.getElementById("adminnotify");
			aspot.innerHTML = "Administrator mode: <button onmouseup='clearcache()'>clear cache</button> <button onmouseup='requestbuildall()'>validate</button><button onmouseup='exploretrash()'>Explore Trash</button><br/>";
		}
		hashmirror = ":" + pnum;
		location.hash = hashmirror;
		x = document.getElementById("photospot");
		y = document.getElementById("preimages");
		z = document.getElementById("counter");
		x.innerHTML = "";
		y.innerHTML = "";
		z.innerHTML = "";

		place = document.getElementById("thumbs") ;
		if(lastimagevalue < 1)
			place.innerHTML = "<br/><h2>The gallery has no images.  Please upload images to the same location as this file($selfurl).  </h2>(Not in a subfolder.)";
		else
			place.innerHTML = thumbpage[pnum];
	}

	//-->
	</script>
	
	<div>
	<noscript><h2>PLEASE ENABLE JAVASCRIPT TO VIEW THIS PAGE.</h2></noscript>

	<div id="prevnext" style="width: 100%; margin-top: 20px;">
	<center>
	<button class="btn btn-primary" onmouseup="leftbutton()">Prev</button>
	<a class="btn btn-link" href="$selfurl#:" onclick="displaythumbs(pnum);return false;"> Thumbnails </a>
	<button class="btn btn-primary" onmouseup="rightbutton()">Next</button>
	</center>
	</div>

	<br/>
	<div id="adminnotify"></div>
	<div id="counter"></div>
	<div id="realtime"></div>

	<div id="thumbs"></div>

	<div id="preloader">
	<a id="preimages">Invisible Text</a>
	</div>
	<br/>
	<div id="photodiv">
		<a id="photospot" onclick="togglefullres()"></a>
	</div>
	<div id="login"></div>
	</div>


END;
	//end of large javascript/html block (this statement cannot be indented)

}
function closewindow()
{
	echo '
	<script>
		window.close();
	</script>
		Buildcache complete.<br/>
		This window should be closed now.<br/><br/><br/>
		';
}

function buildfilearray() //even better way to build array of files, easier to add types
{
	$i = -1;
	global $sortalpha;
	global $reversesort;
	global $cssexists ;
	$cssexists = false;
	$dir = opendir(".");
	while($currentfile = readdir($dir))
	{
		if($currentfile == "goodgallery.css")
			$cssexists = true;
		if(issupported($currentfile))
		{
			$i++;
			$filearray[$i] = $currentfile;
		}
	}
	closedir($dir);
	if($sortalpha)
		natcasesort($filearray);
	if($reversesort)
		$filearray = array_reverse($filearray);
	return $filearray;
}

function issupported($filename)
{
	if(findtype($filename) == "JPG")
		return true;
	if(findtype($filename) == "JPEG")
		return true;
	if(findtype($filename) == "PNG")
		return true;
	if(findtype($filename) == "GIF")
		return true;
	return false;
}

function build($filename) //build echoing the responses
{
	if(!issupported($filename))
		die("exploit attempt detected, script killed");
	echo buildone($filename);
}

function buildall()
{
	global $filearray;
	shuffle($filearray); //makes more sense to do in a crazy order so if nasty php config is killing this early, it'll get all/most in several passes, then any holes will be filled in by on-demand XHR stuff
	foreach($filearray as $currentfile)
	{
		if(is_numeric(buildone($currentfile)))
		{
			echo $currentfile . " successfully built<br/>";
			ob_flush();
			flush();
		}
	}
	foreach(glob("thumbcache/*.tmp") as $currentfile)
		unlink($currentfile);
	foreach(glob("previewcache/*.tmp") as $currentfile)
		unlink($currentfile);
	
	foreach(glob("previewcache/*.*") as $currentfile) // scans for and deletes orphan cache files
	{
		if(!is_file(substr($currentfile, 13, strlen($currentfile) -25))) // strips path info and resized tag, then checks if original exists
			unlink($currentfile);
	}
	foreach(glob("thumbcache/*.*") as $currentfile) // scans for and deletes orphan cache files
	{
		if(!is_file(substr($currentfile, 11, strlen($currentfile) -23))) // strips path info and resized tag, then checks if original exists
			unlink($currentfile);
	}
	echo 1; // signifies it has reached the end.  if this is the lone output, the gallery is said to be validated
}

function buildone($filename) // build one file (thumb/preview) returns number of completed file or failure
{
		global $maxdimension;
		global $previewquality;
		global $thumbquality;
		global $maxthumbdimension;
		$filename = stripslashes(rawurldecode($filename));
		$previewname = 'previewcache/' . $filename . ".resized.jpg" ;
		$thumbname = 'thumbcache/' . $filename . ".resized.jpg" ;
		$whatgotdone = 0;  //1=preview 2=thumb 3=both 0=neither

	if(is_file($filename))
	{
		if(!is_file($previewname))
		{
					//Get proper new width/height for preview
			$dimensions = getimagesize($filename);
			$width = $dimensions[0];
			$height = $dimensions[1];
			if($width == 0)
			{
				@mkdir("ggTrash");
				if(!is_dir("ggTrash"))
					die("permissions error");
				if(is_file("ggTrash/" . $filename))
					@rename("ggTrash/" . $filename, "ggTrash/" . $filename . dupe);
				@rename(stripslashes($filename), "ggTrash/" . $filename);
				die($filename . " rejected due to not being able to get dimensions(likely corrupt file or extension is wrong.<br/>File moved to /ggTrash");
			}
			$ratio = $height / $width;
			$resized = false;
			$interlace = true;
			if(($height >= $width) && ($height > $maxdimension))
			{
				$height = $maxdimension;
				$resized = true;
				$width = ceil($maxdimension / $ratio);
			}
			else
			{
				if(($width > $height) && ($width > $maxdimension))
				{
					$width = $maxdimension;
					$resized = true;
					$height = ceil($maxdimension * $ratio);
				}
			}// at this point new dimensions are in $width and $height
			if(!is_dir("previewcache"))
				@mkdir("previewcache");
			if(!is_dir("previewcache"))
				die("permissions error");
			rawbuild($filename, $previewname, $height, $width, $previewquality, $interlace);
			$whatgotdone += 1;
		}
		if(!is_file($thumbname))
		{
					//Get proper new width/height for thumb
			$dimensions = getimagesize($filename);
			$width = $dimensions[0];
			$height = $dimensions[1];
			$ratio = $height / $width;
			$resized = false;
			$interlace = false;
			if($height > $maxthumbdimension)
			{
				$height = $maxthumbdimension;
				$resized = true;
				$width = ceil($maxthumbdimension / $ratio);
			}
			// at this point new dimensions are in $width and $height
			if(!is_dir("thumbcache"))
				@mkdir("thumbcache");
			rawbuild($filename, $thumbname, $height, $width, $thumbquality, $interlace);
			$whatgotdone += 2;
		}
	}
	if($whatgotdone == 0)
		return "build of " . $filename . " failed.(already exists?)";
	else
		return (int)$_GET["inum"];

} // end buildone()

function rawbuild($filename, $newfilename, $height, $width, $quality, $interlace) //(new height/width)
{
	set_time_limit(30); //gives 30 seconds per image before script timeout (it is ok if the server overrides this)
	$dimensions = getimagesize($filename);
	$buildsuccess = true;
	if($dimensions[0] > $width)
	{
		$destimage = imagecreatetruecolor($width, $height);
		//logic for new types goes here (next line)
		if(findtype($filename) == "JPG" || findtype($filename) == "JPEG")
		{
			if(!imagecopyresampled($destimage, imagecreatefromjpeg($filename), 0, 0, 0, 0, $width, $height, $dimensions[0], $dimensions[1]))
				$buildsuccess = false;
		}
		elseif(findtype($filename) == "PNG")
		{
			if(!imagecopyresampled($destimage, imagecreatefrompng($filename), 0, 0, 0, 0, $width, $height, $dimensions[0], $dimensions[1]))
				$buildsuccess = false;
		}
		elseif(findtype($filename) == "GIF")
		{
			if(!imagecopyresampled($destimage, imagecreatefromgif($filename), 0, 0, 0, 0, $width, $height, $dimensions[0], $dimensions[1]))
				$buildsuccess = false;
		}
	}
	else
	{
				//logic for new types goes here (next line)
		if(findtype($filename) == "JPG" || findtype($filename) == "JPEG")
			$destimage = imagecreatefromjpeg($filename);
		elseif(findtype($filename) == "PNG")
			$destimage = imagecreatefrompng($filename);
		elseif(findtype($filename) == "GIF")
			$destimage = imagecreatefromgif($filename);
		if($destimage === false)
			$buildsuccess = false;
	}
		if($interlace)
			imageinterlace($destimage, 1);
		if($buildsuccess)
		{
			imagejpeg($destimage, $newfilename . ".tmp", $quality);
			@rename($newfilename . ".tmp", $newfilename); // prevents half-written files if script is killed early
		}
		imagedestroy($destimage);
		if(is_file($newfilename)) //check if actions worked (this is easier than having an error condition for each function)
			return true;
		else
		{
/*			@mkdir("ggTrash");
			if(!is_dir("ggTrash"))
				die("permissions error");
			if(is_file("ggTrash/" . $filename))
				@rename("ggTrash/" . $filename, "ggTrash/" . $filename . dupe);
			@rename(stripslashes($filename), "ggTrash/" . $filename);
			echo $filename . " was unbuildable and moved to /ggTrash";
			*/
			return false;
		}
}
function clearcache()
{
	global $password;
	session_start();
	if(!(isset($_SESSION['admin']) && $_SESSION['admin'] === $password))
	{
		echo "no";
		return 1;
	}
	foreach(glob("previewcache/*.*") as $currentfile)
		unlink($currentfile);
	foreach(glob("thumbcache/*.*") as $currentfile)
		unlink($currentfile);
	echo "all thumbnail and preview images deleted.";
}
function movetotrash()
{
	global $password;
	session_start();
	if(!(isset($_SESSION['admin']) && $_SESSION['admin'] === $password))
	{
		echo "no";
		return 1;
	}

	$filename = stripslashes(rawurldecode($_GET['movetotrash']));

// I realize this isn't as precise as it ignores case, but at least it makes it impossible for the script to delete itself; also it's not important to be able to delete non-images at all
	if((strtoupper("/" . $filename)) === strtoupper($_SERVER["PHP_SELF"])) 
	{
		echo "trash myself? no.";
		return 1;
	}

	@mkdir("ggTrash");
	if(!is_dir("ggTrash"))
		die("permissions error");
	$newfilename = "ggTrash/" . $filename ;
	if(@rename($filename, $newfilename))
		echo $filename . " moved to /ggTrash.<br/>To remove all deleted items from this view, re<button onmouseup='requestbuildall()'>validate</button>";
	else
		echo "cannot complete this operation (probably a file exists in the trash of the same filename. Check the trash)";
}
function exploretrash()
{
	global $password;
	session_start();
	if(!(isset($_SESSION['admin']) && $_SESSION['admin'] === $password))
	{
		echo "no";
		return 1;
	}
	echo "----------------Trash Folder - /ggTrash----------------<br/>";
	if(!(@chdir("ggTrash")))
	{
		echo "empty";
		return 1;
	}

	$count = 0;
	foreach(glob("*.*") as $currentfile)
	{
		$ecurrentfile = rawurlencode($currentfile);
		echo "<button onmouseup='restorefile(" .'"'. $ecurrentfile .'"'. ")'>Restore</button>";
		echo "<a href='ggTrash/$ecurrentfile'>$currentfile</a>" . "<button onmouseup='deletefile(" .'"'. $ecurrentfile .'"'. ")'>Delete</button><br/>";
		$count++;
	}
	if($count == 0)
		echo "empty";
	else
	{
		echo "----------------Trash Folder - /ggTrash----------------<br/>";
		echo "<br/><br/><br/><button onmouseup='restoreall()'>restore all trashed files</button><br/><button onmouseup='emptytrash()'>empty trash</button>";
	}
}
function deletefile($currentfile)
{
	global $password;
	session_start();
	if(!(isset($_SESSION['admin']) && $_SESSION['admin'] === $password))
	{
		echo "no";
		return 1;
	}
	$currentfile = stripslashes(rawurldecode($currentfile));
	if(@unlink('ggTrash/' . $currentfile))
		echo $currentfile . " deleted.";
	else
		echo "cannot delete (doesn't exist?)";

}
function restorefile($currentfile)
{
	global $password;
	session_start();
	if(!(isset($_SESSION['admin']) && $_SESSION['admin'] === $password))
	{
		echo "no";
		return 1;
	}
	$currentfile = stripslashes(rawurldecode($currentfile));
	if(!is_file("ggTrash/" . $currentfile))
	{
		echo $currentfile . " not found in trash.";
		return 1;
	}
	if(is_file($currentfile))
	{
		echo "I cannot restore this file because the gallery has a file of the same filename already";
		return 1;
	}
	rename("ggTrash/" . $currentfile, $currentfile);
	echo "restored " . $currentfile . "<br/>";
}
function restoreall()
{
	global $password;
	session_start();
	if(!(isset($_SESSION['admin']) && $_SESSION['admin'] === $password))
	{
		echo "no";
		return 1;
	}
	foreach(glob("ggTrash/*.*") as $current)
	{
		$currentfile = array_pop(explode('ggTrash/', $current));
		restorefile($currentfile);
	}
}

function emptytrash()
{
	global $password;
	session_start();
	if(!(isset($_SESSION['admin']) && $_SESSION['admin'] === $password))
	{
		echo "no";
		return 1;
	}
	foreach(glob("ggTrash/*.*") as $current)
	{
		$currentfile = array_pop(explode('ggTrash/', $current));
		deletefile($currentfile);
	}
}

//main program

if(isset($_GET["t"]) && is_numeric($_GET["t"]))
	$thumbsperpage = $_GET["t"];

if(((int) array_pop(array_reverse(explode("M", ini_get('memory_limit'))))) < 512)
	ini_set('memory_limit','512M');

//Error reporting is forced on because the js uses the error output to figure out problems
ini_set('display_errors', 1);
error_reporting(E_ERROR & E_WARNING & E_PARSE);

if(!function_exists("ImageCreateTrueColor"))
{
	echo "GD 2.x image library not found.  This comes with php4 and higher, so it probably just needs to be enabled.<br/>See php.net or contact your hosting provider.<br/>";
	die("Fatal error: GD missing");
}

if(is_numeric($_GET["buildall"]))
{
	$filearray = buildfilearray();
	buildall();
}
elseif(is_string($_GET["build"]))
	build($_GET["build"]);
elseif(isset($_GET['clearcache']))
	clearcache();
elseif(isset($_GET['emptytrash']))
	emptytrash();
elseif(isset($_GET["exploretrash"]))
	exploretrash();
elseif(isset($_GET["deletefile"]))
	deletefile($_GET["deletefile"]);
elseif(isset($_GET["restorefile"]))
	restorefile($_GET["restorefile"]);
elseif(isset($_GET["restoreall"]))
	restoreall();
elseif(isset($_GET["movetotrash"]))
	movetotrash();
else
{
	$filearray = buildfilearray();
	$lastimagevalue = lastimagevalue();
	if(!($password === "default"))
		session_start();
	htmltop();
	fastdisplayimage();
	htmlbottom(); //Please don't remove my link :)
}
?>
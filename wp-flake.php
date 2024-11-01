<?php
/*
Plugin Name: Flake
Plugin URI: http://raz-soft.com/
Description: Decorative purposes plugin: Snow effect on your blog. A lightweight, hassle free experience. Just click activate and have a look at your blog ;-). See <strong>Options->Flake</strong> for customization.
Author: <strong>Raz</strong>van Serban (razvaR at gmail dot com)
Version: 0.0.2
Author URI: http://raz-soft.com/
*/

$wp_flake_version = '<b>v0.0.2</b> <br />';



//let's add the flake...
function wp_flake_addflake()
{
   //Thanks Kurt Grigg fir the snow effect java alg: http://www.btinternet.com/~kurt.grigg/javascript
   $option  = get_option('wp_flake_options');
   //print_r($option);
?>
	
<script type="text/javascript">	
 	if  ((document.getElementById) &&
 	window.addEventListener || window.attachEvent){
 	(function(){
 	var num = <?php echo $option['num']; ?> ;   //Number of flakes
 	var timer = <?php echo $option['timer']; ?>; //setTimeout speed. 
 	var y = [];
 	var x = [];
 	var fall = [];
 	var theFlakes = [];
 	var sfs = [];
 	var step = [];
 	var currStep = [];
 	var h,w,r;
 	var d = document;
 	var pix = "px";
 	var domWw = (typeof window.innerWidth == "number");
 	var domSy = (typeof window.pageYOffset == "number");
 	var idx = d.getElementsByTagName('div').length;
 	if (d.documentElement.style &&
 	typeof d.documentElement.style.MozOpacity == "string")
 	num =<?php echo $option['num']; ?>;
 	if (num&1) num++;
 	
 	for (i = 0; i < num/2; i++){
 	sfs[i] = Math.round(<?php echo $option['f1minsize']; ?> + Math.random() * <?php echo $option['f1maxsize']; ?>);
 	document.write('<div id="flake'+(idx+i)+'" style="background: transparent;z-index: <?php echo $option['f1z']; ?>;position:absolute;top:0px;left:0px;width:'+sfs[i]+'px;height:'+sfs[i]+'px;color:<?php echo $option['f1color']; ?>;font-size:'+sfs[i]+'px"><?php echo $option['f1char']; ?></div>');
 	currStep[i] = 0;
 	fall[i] = (sfs[i] == 1)?
 	Math.round(2 + Math.random() * 2): Math.round(3 + Math.random() * 2);
 	step[i] = (sfs[i] == 1)?
 	0.05 + Math.random() * 0.1 : 0.05 + Math.random() * 0.05 ;
 	}
  	for (i =num/2; i < num; i++){
 	sfs[i] = Math.round(<?php echo $option['f2minsize']; ?>+ Math.random() * <?php echo $option['f2maxsize']; ?>);	
 	document.write('<div id="flake'+(idx+i)+'" style="background: transparent;z-index: <?php echo $option['f2z']; ?>;position:absolute;top:0px;left:0px;width:'+sfs[i]+'px;height:'+sfs[i]+'px;color:<?php echo $option['f2color']; ?>;font-size:'+sfs[i]+'px"><?php echo $option['f2char']; ?></div>');
 	currStep[i] = 0;
 	fall[i] = (sfs[i] == 1)?
 	Math.round(2 + Math.random() * 2): Math.round(3 + Math.random() * 2);
 	step[i] = (sfs[i] == 1)?
 	0.05 + Math.random() * 0.1 : 0.05 + Math.random() * 0.05 ;
 	}	
 	if (domWw) r = window;
 	else{ 
 	  if (d.documentElement &&
 	  typeof d.documentElement.clientWidth == "number" &&
 	  d.documentElement.clientWidth != 0)
 	  r = d.documentElement;
 	 else{
 	  if (d.body &&
 	  typeof d.body.clientWidth == "number")
 	  r = d.body;
 	 }
 	}
 	function winsize(){
 	var oh,sy,ow,sx,rh,rw;
 	if (domWw){
 	  if (d.documentElement && d.defaultView &&
 	  typeof d.defaultView.scrollMaxY == "number"){
 	  oh = d.documentElement.offsetHeight;
 	  sy = d.defaultView.scrollMaxY;
 	  ow = d.documentElement.offsetWidth;
 	  sx = d.defaultView.scrollMaxX;
 	  rh = oh-sy;
 	  rw = ow-sx;
 	 }
 	 else{
 	  rh = r.innerHeight;
 	  rw = r.innerWidth;
 	 }
 	h = rh - 10; 
 	w = rw - 10;
 	}
 	else{
 	h = r.clientHeight - 10;
 	w = r.clientWidth - 10;
 	}
 	}
 	function scrl(yx){
 	var y,x;
 	if (domSy){
 	 y = r.pageYOffset;
 	 x = r.pageXOffset;
 	 }
 	else{
 	 y = r.scrollTop;
 	 x = r.scrollLeft;
 	 }
 	return (yx == 0)?y:x;
 	}
 	function snow(){
 	var dy,dx,lft;
 	
 	for (i = 0; i < num; i++){
 	 dy = fall[i];
 	 dx = fall[i] * Math.cos(currStep[i]); 	 
 	 y[i]+=dy;
 	 x[i]+=dx;
 	 if (x[i] >= (w-sfs[i]-10) || y[i] >= h){
 	  y[i] = -10;
 	  x[i] = Math.round(Math.random() * (w-10));
 	  fall[i] = (sfs[i] == 1)?
 	  Math.round(2 + Math.random() * 2): Math.round(3 + Math.random() * 2);
 	  step[i] = (sfs[i] == 1)?
 	  0.05 + Math.random() * 0.1 : 0.05 + Math.random() * 0.05 ;
 	  
 	 }
 	 theFlakes[i].top = y[i] + scrl(0) + pix;
 	 lft=x[i] + scrl(1) + pix;
 	 //if (lft+sfs[i]>=w) lft=w-sfs[i]-5;
 	 
 	 theFlakes[i].left =lft ;
 	 
 	 currStep[i]+=step[i];
 	}
 	setTimeout(snow,timer);
 	}
 	function init(){
 	winsize();
 	for (i = 0; i < num; i++){
 	 var fl=document.getElementById("flake"+(idx+i));
	  theFlakes[i] = document.getElementById("flake"+(idx+i)).style;
	  
 	 y[i] = Math.round(Math.random()*h);
 	 x[i] = Math.round(Math.random()*(w-sfs[i]*2));
 	}
 	snow();
 	}
 	if (window.addEventListener){
 	 window.addEventListener("resize",winsize,false);
 	 window.addEventListener("load",init,false);
 	} 
 	else if (window.attachEvent){
 	 window.attachEvent("onresize",winsize);
 	 window.attachEvent("onload",init);
 	} 
 	})();
 	}
</script>	
<?php	
}


//----------------------------------------------------------------
//Wordpress Options page goes here...
//----------------------------------------------------------------

function Flake_Page() 
{
	global $wp_flake_version; //$wpdb, $table_prefix
	$option  = get_option('wp_flake_options');

				
if (isset($_POST['savesett'])) 
  {
   //TODO: save settings
    $option['num']=$_POST['fnum'];
	$option['timer']=$_POST['ftimer'];; 
    $option['f1color']=$_POST['f1color'];; 
    $option['f1char']=$_POST['f1char'];;
    $option['f1minsize']=$_POST['f1minsize'];;
    $option['f1maxsize']=$_POST['f1maxsize'];;
    $option['f1z']=$_POST['f1z'];;
    
    $option['f2color']=$_POST['f2color'];; 
    $option['f2char']=$_POST['f2char'];;
    $option['f2minsize']=$_POST['f2minsize'];;
    $option['f2maxsize']=$_POST['f2maxsize'];;
	$option['f2z']=$_POST['f2z'];
	
	update_option('wp_flake_options', $option);
	
?>
<div id="message" class="updated fade"><p><strong><?php  _e('Flake Options updated.', 'mt_trans_domain' ); ?></strong></p></div>
<?php
  }
?>
<div class="wrap">		
		<fieldset class="option">
			<form name="manageoptions" id="manageoptions" method="post">			
			<h2>Flake Options</h2>

<p>Number of flakes: <input type="text" name="fnum" id="fnum" size="5" value="<?php echo $option['num']; ?>" /></p>
<p>Timeout speed: <input type="text" name="ftimer" id="ftimer" size="5" value="<?php echo $option['timer']; ?>" /></p>

<p>&nbsp;</p>

<p>Flake 1 color: <input type="text" name="f1color" id="f1color" size="7" value="<?php echo $option['f1color']; ?>" /></p>
<p>Flake 1 character: <input type="text" name="f1char" id="f1char" size="7" value="<?php echo $option['f1char']; ?>" /></p>
<p>Flake 1 minimum size: <input type="text" name="f1minsize" id="f1minsize" size="7" value="<?php echo $option['f1minsize']; ?>" /></p>
<p>Flake 1 maximum size: <input type="text" name="f1maxsize" id="f1maxsize" size="7" value="<?php echo $option['f1maxsize']; ?>" /></p>
<p>Flake 1 Z index (order): <input type="text" name="f1z" id="f1z" size="7" value="<?php echo $option['f1z']; ?>" /></p>

<p>&nbsp;</p>

<p>Flake 2 color: <input type="text" name="f2color" id="f2color" size="7" value="<?php echo $option['f2color']; ?>" /></p>
<p>Flake 2 character: <input type="text" name="f2char" id="f2char" size="7" value="<?php echo $option['f2char']; ?>" /></p>
<p>Flake 2 minimum size: <input type="text" name="f2minsize" id="f2minsize" size="7" value="<?php echo $option['f2minsize']; ?>" /></p>
<p>Flake 2 maximum size: <input type="text" name="f2maxsize" id="f2maxsize" size="7" value="<?php echo $option['f2maxsize']; ?>" /></p>
<p>Flake 2 Z index (order): <input type="text" name="f2z" id="f2z" size="7" value="<?php echo $option['f2z']; ?>" /></p>

<p>&nbsp;</p>
<p>&nbsp;</p>

		<p>&nbsp;&nbsp;</p>	
		<p align="center"><input name="savesett" type="submit" style="font-weight:bold" value="&nbsp;&nbsp;Update Options...&nbsp;&nbsp;" /></p>	
<!-- <input type="hidden" id="sett123" name="sett123" value="" />-->											
			</form> 
		</fieldset>


		<h2>&nbsp;&nbsp;</h2>

		
		<br />
		<p align="center">Powered by <br /> <a href="http://raz-soft.com/about" title="Raz"><img alt="Raz" src="<?php echo get_option('home').'/wp-content/plugins/wp-flake/img/raz.gif'; ?>" /></a><br /> <small><?php echo $wp_flake_version ?></small></p>
		<p align="center"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=donations@raz-soft.com&currency_code=&amount=&return=&item_name=donation+for+wp-flake" title="Donate"><img alt="Donate" src="<?php echo get_option('home').'/wp-content/plugins/wp-flake/img/paypalDonate.gif'; ?>" /></a><br /> </p>
	    
		<h2>&nbsp;&nbsp;</h2>
	</div>
<?php	

}

//----------------------------------------------------------------
//... and will end here...
//----------------------------------------------------------------



//install the plugin
function wp_flake_install() 
{
	//global $wpdb, $table_prefix;
	
	$option  = array();
    $option['num']=25;
	$option['timer']=30; 
    $option['f1color']="#FFFFFF"; 
    $option['f1char']="*";
    $option['f1minsize']=5;
    $option['f1maxsize']=8;
    $option['f1z']=9999;
    
    $option['f2color']="#AAFFFF"; 
    $option['f2char']="*";
    $option['f2minsize']=8;
    $option['f2maxsize']=12;
	$option['f2z']=9999;
	    
	
	add_option('wp_flake_options', $option, 'Wp-Flake Plugin Settings');

}


//------------------------------------------------------------------------------
//add plugin submenu in Wordpress
//------------------------------------------------------------------------------

function wp_flake_configuration() 
{
	if (function_exists('add_submenu_page')) {
		add_options_page('Flake', 'Flake', 8, basename(__FILE__), 'Flake_Page');
	}
	
}

//uninstall the plugin, clean up...
function wp_flake_uninstall() 
{
	delete_option('wp_flake_options');

}


//-----------------------------------------------------------------------------------
// add Wordpress actions and filters

add_action('activate_wp-flake/'.basename(__FILE__), 'wp_flake_install');
add_action('deactivate_wp-flake/'.basename(__FILE__), 'wp_flake_uninstall');
add_action('admin_menu', 'wp_flake_configuration');
add_action('wp_footer', 'wp_flake_addflake');

/*add_action('register_form', 'captcha_register');
add_action('login_form', 'captcha_login');
add_action('init', 'init_captcha');

add_filter('registration_errors', 'check_captcha_register'); 
add_action('wp_authenticate', 'check_captcha_login');

add_action('login_head' ,'add_refresh_captcha');
*/

?>
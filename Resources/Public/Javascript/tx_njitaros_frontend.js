/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var _njitaros_SEL_CAROUSEL_HEADER;
var _njitaros_SEL_CAROUSEL_HEADER_SLIDES;
var _njitaros_SEL_CAROUSEL_HEADER_SHEET;
var _njitaros_SEL_CAROUSEL_HEADER_VERSION;
var _njitaros_SEL_CAROUSEL_HEADER_CONTROLS;

var _njitaros_carousel_header_interval;
var _njitaros_carousel_header_number_of_items;
var _njitaros_carousel_header_width;
var _njitaros_carousel_header_height;


$(document).ready(function() 
{
	tx_njitaros_carousel_header_init();
});

document.addEventListener('DOMContentLoaded', function(event) 
{
	
	$(document).on("click", _njitaros_SEL_CAROUSEL_HEADER_CONTROLS + ' LI.inactive', function()
	{
		tx_njitaros_carousel_header_slider(true,$(this).attr("data-sheet"));
	});
});

function tx_njitaros_carousel_header_setVars()
{
	_njitaros_carousel_header_number_of_items = $(_njitaros_SEL_CAROUSEL_HEADER_SHEET).length;
	_njitaros_carousel_header_width = $(_njitaros_SEL_CAROUSEL_HEADER_SLIDES).width();
	_njitaros_carousel_header_height = $(_njitaros_SEL_CAROUSEL_HEADER_SLIDES).height();
}

function tx_njitaros_carousel_header_init()
{
	tx_njitaros_carousel_header_setVars();

	switch(_njitaros_SEL_CAROUSEL_HEADER_VERSION) 
	{
		case "1":
			$(_njitaros_SEL_CAROUSEL_HEADER_SHEET).hide(0).children(".title h2, .title, h3").hide(0);
	
			$(_njitaros_SEL_CAROUSEL_HEADER_SHEET).first()
				.css({opacity:0,marginTop:"-"+_njitaros_carousel_header_height+"px"})
				.show(0)
				.children(".title").css({marginLeft:"-"+_njitaros_carousel_header_width+"px"}).show(0);
			break;
		case "2":
			$(_njitaros_SEL_CAROUSEL_HEADER_SHEET).first().find(".image IMG")
				.css({maxWidth:0});
				//.css({marginLeft:"-" + $(_njitaros_SEL_CAROUSEL_HEADER_SHEET + ' .image').width() + "px"});
			$(_njitaros_SEL_CAROUSEL_HEADER_SHEET).find(".title h2").css({
				marginLeft:'-'+$(_njitaros_SEL_CAROUSEL_HEADER_SHEET + ' .title').width()+'px',
				maxWidth:$(_njitaros_SEL_CAROUSEL_HEADER_SHEET + ' .title').width()+'px'
			});
			$(_njitaros_SEL_CAROUSEL_HEADER_SHEET).find(".title h3").css({
				marginLeft:'-'+$(_njitaros_SEL_CAROUSEL_HEADER_SHEET + ' .title').width()+'px',
				maxWidth:$(_njitaros_SEL_CAROUSEL_HEADER_SHEET + ' .title').width()+'px'
			});
			
			//$(_njitaros_SEL_CAROUSEL_HEADER_SHEET).first()
			$(_njitaros_SEL_CAROUSEL_HEADER_SHEET).not($(_njitaros_SEL_CAROUSEL_HEADER_SHEET).first()).css({opacity:0});	
	
			break;
		default:;
	}
}



function tx_njitaros_carousel_header_start()
{
	var index=1;
	
	switch(_njitaros_SEL_CAROUSEL_HEADER_VERSION) 
	{	
		case "1":
			$(_njitaros_SEL_CAROUSEL_HEADER_SHEET).first().animate(
				{opacity:100,marginTop:0},
				1500,'easeInBounce',
				function()
				{	
					$(this).attr("data-status",_STATUS_ACTIVE);
					$(this).children(".title").animate({marginLeft:0},250,function()
					{
						_njitaros_carousel_header_interval = tx_njcollection_timeoutInterval(function(){tx_njitaros_carousel_header_slider();}, 10000);
					});
				}
			);	
			break;
		case "2":
			$(_njitaros_SEL_CAROUSEL_HEADER_SHEET).first().find("IMG").animate(
				{maxWidth:'100%'},250,'easeInBounce',function()
				{
					$(_njitaros_SEL_CAROUSEL_HEADER_SHEET).first().find(".title h2")
						.animate({
							marginLeft:0,
							maxWidth:'100%'
						},250,'easeInBounce',function()
							{
								$(_njitaros_SEL_CAROUSEL_HEADER_SHEET).first().find(".title h3")
									.animate({
										marginLeft:'75px',
										maxWidth:'100%'
									},250,'easeInBounce',function(){
										_njitaros_carousel_header_interval = tx_njcollection_timeoutInterval(function(){tx_njitaros_carousel_header_slider();}, 10000);
									}
								);
							}
						);
					
					$(_njitaros_SEL_CAROUSEL_HEADER_CONTROLS + ' LI').first().toggleClass("active","inactive");
				}
			);
			break;
		default:;
	} 
}


var blah = 1;
function tx_njitaros_carousel_header_slider(click,sheet)
{
	tx_njitaros_carousel_header_setVars();
	
	var actElement = $(_njitaros_SEL_CAROUSEL_HEADER_SHEET + '[data-status="'+_STATUS_ACTIVE+'"]');
	var nextElement = actElement.next();
	
	if(actElement.is(":last-child"))
	{
		nextElement = $(_njitaros_SEL_CAROUSEL_HEADER_SHEET).first();
	}
	
	if(click === true && typeof("sheet") !== "undefined")
	{
		nextElement = $(_njitaros_SEL_CAROUSEL_HEADER_SHEET+'[data-sheet="'+sheet+'"]');
	}
	
	switch(_njitaros_SEL_CAROUSEL_HEADER_VERSION) 
	{	
		case "1":
			actElement.children(".title").toggle("scale","fast");
			actElement.children(".image").toggleClass("blur","");
			actElement.animate({marginLeft:"-1600px",opacity:0},1500,'easeOutBounce',function(){ $(this).attr("data-status",_STATUS_INACTIVE).children(".image").toggleClass("blur",""); });
			nextElement.css({marginLeft:"-1600px",opacity:0}).show().animate({marginLeft:"0",opacity:100},750,'easeInBounce',function(){ $(this).attr("data-status",_STATUS_ACTIVE).children(".title").toggle("scale","fast"); });
			break;
		case "2":
			actElement.animate({opacity:0},1500,'',function(){}).attr("data-status",_STATUS_INACTIVE);
			nextElement.animate({opacity:100},1500,'',function(){ }).attr("data-status",_STATUS_ACTIVE);
			
			actElement.find(".title h3").animate({
				marginLeft:'-'+$(_njitaros_SEL_CAROUSEL_HEADER_SHEET + ' .title').width()+'px',
				maxWidth:$(_njitaros_SEL_CAROUSEL_HEADER_SHEET + ' .title').width()+'px'
			},250,'',function(){
				actElement.find(".title h2").animate({
					marginLeft:'-'+$(_njitaros_SEL_CAROUSEL_HEADER_SHEET + ' .title').width()+'px',
					maxWidth:$(_njitaros_SEL_CAROUSEL_HEADER_SHEET + ' .title').width()+'px'
				},250,'',function(){
					//next step (if needed)
				});
			});
			
			setTimeout(function(){
				nextElement.find(".title h2").animate({
						marginLeft:0,
						maxWidth:'100%'
				},250,'',function(){
					nextElement.find(".title h3").animate({
						marginLeft:'75px',
						maxWidth:'100%'
					},250,'',function(){
						//next step (if needed)
					});
				});
			}, 1500);
			
			
			
			
			
			$(_njitaros_SEL_CAROUSEL_HEADER_CONTROLS + ' LI.active').removeClass("active").addClass("inactive");
			$(_njitaros_SEL_CAROUSEL_HEADER_CONTROLS + ' LI[data-task="tx_njitaros_carousel_header_switch_sheet_'+nextElement.attr("data-sheet")+'"]').removeClass("inactive").addClass("active");
			
			if(click === true && typeof("sheet") !== "undefined")
			{
				//TODO
			}
			break;
		default:;
	
	}
}


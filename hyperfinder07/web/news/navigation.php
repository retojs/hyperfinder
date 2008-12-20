<?php

$NOF_NAV_ITEMS = 12;
$nof_nav_items = $NOF_NAV_ITEMS / 2;

/**
 * This file is meant to be included inside a 
 * 
 * 		foreach ($items as $i => $item) loop.
 * 
 * It then displays a line of links numbered from 1 to 10
 * that calls the javascript function 
 * 
 * 		show_item(id)
 *
 * with id starting with $prefix followed by the clicked number
 * 
 * The loop needs to generate the DIVs to be displayed or hidden by this. 
 *
 */

function printNavigation($ITEMS, $i) {
	
	global $nof_nav_items;
	
?>
<div class="items_navigation" align="center">
	<?php
		
		$navString = "";
		$morePrefix = "...";
		$moreSuffix = "...";
		$emptyPrefix = "&nbsp;&nbsp;&nbsp;";
		$emptySuffix = "&nbsp;&nbsp;&nbsp;";
		$navBtnOpen = "<span class=\"navigation_btn #NAVCLASS#\" onclick=\"#ONCLICK#\">";
		$navBtnClose = "</span>";
		
		// create space to balance the rssticker_stopped span
		for ($z = 0; $z < $nof_nav_items; $z++) {
			print "&nbsp;";
		}

		// create the navigation (zurück, 1, 2, 3, 4 etc )
		if ($i > 0) {
			$navBtnOpen_ = str_replace("#ONCLICK#", "show_item('" . ($i-1) . "'); continueTicker()", $navBtnOpen);
			$navBtnOpen_ = str_replace("#NAVCLASS#", "", $navBtnOpen_);
			$navBtnOpen2_ = str_replace("#ONCLICK#", "show_item('0'); continueTicker()", $navBtnOpen);
			$navBtnOpen2_ = str_replace("#NAVCLASS#", "", $navBtnOpen2_);
		} else {
			$navBtnOpen_ = str_replace("#ONCLICK#", "", $navBtnOpen);
			$navBtnOpen_ = str_replace("#NAVCLASS#", "nav_btn_disabled", $navBtnOpen_);
			$navBtnOpen2_ = $navBtnOpen_;
		}
		print $navBtnOpen2_ . "<span style=\"vertical-align:middle\"><img src=\"img/toBegin.gif\"></span>" . $navBtnClose;
		print $navBtnOpen_ . "<span style=\"vertical-align:middle\"><img src=\"img/back.gif\"></span>" . $navBtnClose;

		// create the single item links (1, 2, 3, 4 etc.)
		if (sizeof($ITEMS) > 1) {
			
			foreach ($ITEMS as $k => $item) {

				// only display max $NOF_NAV_ITEMS items.
				$lowerLimit = $i - $nof_nav_items;
				$upperLimit = $i + $nof_nav_items;
				if ($lowerLimit < 0) {
					 $upperLimit -= $lowerLimit;
				}
				if ($upperLimit >= sizeof($ITEMS)) {
					 $lowerLimit -= ($upperLimit - sizeof($ITEMS)) + 1;
				}
				if ($k < $lowerLimit) {
					$navString .= $morePrefix;
					$morePrefix = "";
					$emptyPrefix = "";
					continue;
				} 
				if ($k > $upperLimit) {
					$navString .= $moreSuffix;
					$moreSuffix = "";
					$emptySuffix = "";
					continue;
				} 
				
				// two digits
				$filler = "";
				
				if ($k < 10) {
					$filler = "<span style=\"visibility:hidden; padding-left:0px\">0</span>";
				}

				if ($k == $i) {
					$navBtnOpen_ = str_replace("#ONCLICK#", "", $navBtnOpen);
					$navBtnOpen_ = str_replace("#NAVCLASS#", "nav_btn_active", $navBtnOpen_);
				} else {
					$navBtnOpen_ = str_replace("#ONCLICK#", "show_item('$k'); continueTicker()", $navBtnOpen);
					$navBtnOpen_ = str_replace("#NAVCLASS#", "", $navBtnOpen_);
				}
				$navString .= $navBtnOpen_ . $filler . $k . $navBtnClose;
			}
			$navString = $emptyPrefix . $navString . $emptySuffix;
			
			print $navString;
		}

		if ($i < (sizeof($ITEMS) - 1)) {
			$navBtnOpen_ = str_replace("#ONCLICK#", "show_item('" . ($i+1) . "'); continueTicker()", $navBtnOpen);
			$navBtnOpen_ = str_replace("#NAVCLASS#", "", $navBtnOpen_);
			$navBtnOpen2_ = str_replace("#ONCLICK#", "show_item('" . (sizeof($ITEMS) - 1) . "'); continueTicker()", $navBtnOpen);
			$navBtnOpen2_ = str_replace("#NAVCLASS#", "", $navBtnOpen2_);
		} else {
			$navBtnOpen_ = str_replace("#ONCLICK#", "", $navBtnOpen);
			$navBtnOpen_ = str_replace("#NAVCLASS#", "nav_btn_disabled", $navBtnOpen_);
			$navBtnOpen2_ = $navBtnOpen_;
		}
		print $navBtnOpen_ . "<span style=\"vertical-align:middle\"><img src=\"img/forward.gif\"></span>" . $navBtnClose;
		print $navBtnOpen2_ . "<span style=\"vertical-align:middle\"><img src=\"img/toEnd.gif\"></span>" . $navBtnClose;
		
	?>
	<span id="rssticker_stopped<?php print $i; ?>" style="visibility:hidden">(angehalten)</span>
</div>
<?php
}
?>

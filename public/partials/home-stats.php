<?php

$open       = $cases->totals->Open + $cases->totals->Assigned;
$closed     = $cases->totals->Closed;

$html .= "<div class=\"main-overview\">";

$html .= "<div class=\"card cases-overview\">";
$html .= "<header class=\"card-header\">";
$html .= "<h4 class=\"h5\">Support Cases Overview <small><a href=\"".site_url('/cases')."\">View all cases</a></small></h4>";
$html .= "</header>";
$html .= "<div class=\"stat case-total\">";
$html .= "<span class=\"amount\">$cases->total</span>";
$html .= "<span class=\"amount-title\">Total cases</span>";
$html .= "</div>";
$html .= "<div class=\"stat case-open\">";
$html .= "<span class=\"amount\">$open <small>of $cases->total</small></span>";
$html .= "<span class=\"amount-title\">Open cases</span>";
$html .= "</div>";
$html .= "<div class=\"stat case-closed\">";
$html .= "<span class=\"amount\">$closed <small>of $cases->total</small></span>";
$html .= "<span class=\"amount-title\">Closed cases</span>";
$html .= "</div>";
$html .= "<div class=\"chartjs\">";
$html .= "<canvas id=\"myChart\" width=\"100px\" height=\"100px\"></canvas>";
$html .= "</div>";
$html .= "</div>";

$html .= "<div class=\"card printers-overview\">";
$html .= "<header class=\"card-header\">";
$html .= "<h4 class=\"h5\">Managed Printers Overview <small><a href=\"".site_url('/printers')."\">View all printers</a></small></h4>";
$html .= "</header>";
$html .= "<div class=\"stat printer-total\">";
$html .= "<span class=\"amount\">$printers->total</span>";
$html .= "<span class=\"amount-title\">Printers</span>";
$html .= "</div>";
$html .= "<div class=\"classes\">";
foreach ($printers->totals as $key => $val) {
    $class = $classes->$key;
    $html .= "<div class=\"stat class\">";
    $html .= "<div class=\"image\" role=\"cell\">";
    if (isset($class->class_image)) {
        $html .= "<img src=\"{$class->class_image}\" alt=\"\">";
    } else {
        $html .= "<img src=\"\" alt=\"\">";
    }
    $html .= "</div>";
    $html .= "<span class=\"amount\">{$val}</span>";
    $html .= "<span class=\"amount-title\">{$class->name}</span>";
    $html .= "</div>";
}
$html .= "</div>";
$html .= "<div class=\"chartjs\">";
$html .= "<canvas id=\"printersChart\" width=\"100px\" height=\"100px\"></canvas>";
$html .= "</div>";
$html .= "</div>";

$html .= "<div class=\"card upgrades-overview\">";
$html .= "<header class=\"card-header\">";
$html .= "<h4 class=\"h5\">Printer Upgrades Overview</h4>";
$html .= "</header>";
$html .= "<div class=\"chartjs\">";
$html .= "<canvas id=\"printersChart\" width=\"100px\" height=\"100px\"></canvas>";
$html .= "</div>";
$html .= "</div>";


$html .= "</div>";

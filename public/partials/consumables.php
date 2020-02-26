<?php

$dropdown = array('' => 'Select Printer');
foreach ($classes as $class) {
    if ($class->family == "Software") {continue;}
    $dropdown[$class->class_code] = $class->name;
}

if (!$consumables) {
    $consumables = new stdClass;
    $consumables->default = '';
}   
$count = count((array)$consumables);
$row = 1;

$html .= "<div class=\"page-header\">";
    $html .= "<div class=\"page-title\">";
        $html .= "<h3 class=\"title\">My Product consumables</h3>";
        $html .= "<p class=\"intro\">Enter a default consumables link to yor website. This link with be shown to customers through the CLIX app.</p>";
    $html .= "</div>";
$html .= "</div>";

$html .= "<div class=\"page-grid\">";
    $html .= "<div class=\"card table consumable-links\">";
        $html .= "<header class=\"card-header\">";
            $html .= "<h4 class=\"h5\">Consumables links</h4>";
        $html .= "</header>";
        $html .= "<form method=\"post\" id=\"consumablesForm\" data-action=\"consumables\" enctype=\"multipart/form-data\">";
            $html .= "<div class=\"default-link\">";     
                $html .= MagiConnect_Formfields::formfield('', 'class[]', 'hidden', 'default', '',);
                $html .= "<span class=\"icon\"><i class=\"fad fa-browser\"></i></span>";
                $html .= "<span class=\"label\">Default Link:</span>";
                $html .= "<input type=\"url\" name=\"link[]\" value=\"{$consumables->default}\" placeholder=\"Enter default consumable url\">";
            $html .= "</div>";
            $html .= "<div id=\"rows\" class=\"table-rows\">";
                foreach ($consumables as $key => $val) {
                    if ($key == 'default') {continue;}
                    $html .= "<div id=\"row{$row}\" class=\"table-row consumable-row\" role=\"row\">";
                        $html .= "<div class=\"img\"><img src=\"{$classes->{$key}->class_image}\" ></div>";
                        $html .= MagiConnect_Formfields::plainDropDown('', 'class[]', $key, '', $dropdown);
                        $html .= "<input class=\"value\" type=\"url\" name=\"link[]\" value=\"{$val}\" placeholder=\"Enter consumables url\">";
                        $html .= "<span class=\"delete\"><a href=\"\" class=\"redBtn remove\" id=\"remove{$row}\" data-remove=\"{$row}\">Delete</a></span>";
                    $html .= "</div>";
                    $row++;
                }
            $html .= "</div>";
            $html .= "<div class=\"consumables-footer\">";
                $html .= "<div class=\"buttons\">";
                    $html .= "<a href=\"\" class=\"blueBtn\" id=\"addRow\" data-new=\"{$row}\">Add link</a>"; 
                    $html .= "<input type=\"submit\" name=\"save\" id=\"save\" value=\"Save links\" class=\"inputField\">";
                $html .= "</div>";
            $html .= "</div>";
        $html .= "</form>";
    $html .= "</div>";

    $html .= "<div class=\"card clix\">";
        $html .= "<span class=\"preview\">{$consumables->default}</span>";
    $html .= "</div>";
$html .= "</div>";

$html .= "<script>var classArray = ".json_encode($dropdown)."</script>";
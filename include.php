<?php

function WriteHeaders($Heading = "", $Titlebar = "") {
    echo "
    <!doctype html> 
    <html lang = \"en\">
        <head>
            <meta charset = \"UTF-8\">
            <title>$Titlebar</title>
            <link rel=\"stylesheet\" type = \"text/css\" href=\"style.css\">
        </head>
    <body>
    <h1>$Heading   
    ";
}

function DisplayLabel($Label) {
    echo "
        <label>$Label</label>
    ";
}

function DisplayTextbox($InputType, $Name, $Size, $Value = "") {
    echo "
        <input type = $InputType name = \"$Name\" Size = $Size value = \"$Value\"
    ";
}


function DisplayImage($Filename, $Alt, $Height, $Width) {
    echo "
    <img src=\"$Filename\" alt=\"$Alt\" width=\"$Width\" height=\"$Height\"
    ";
}

function DisplayButton($Name, $Text = "", $Image = "") {
    echo "<button type=submit name=\"$Name\">$Image $Text</button> ";
}

function DisplayContactInfo() {
    echo "
        <footer>
            <p>Questions?</p>
            <p>Comments?</p>
            <a href=\"mailto:sam.marrello@student.sl.on.ca\">Email me</a>
        </footer>
    ";
}

function WriteFooters() {
    echo "
    </body>";
    DisplayContactInfo();
    echo "</html>
    ";
}

function createConnectionObject() {
    $fh = fopen('auth.txt', 'r');
    $Host =  trim(fgets($fh));
    $UserName = trim(fgets($fh));
    $Password = trim(fgets($fh));
    $Database = trim(fgets($fh));
    $Port = trim(fgets($fh));
    fclose($fh);

    $mysqlObj = new mysqli($Host, $UserName, $Password, $Database, $Port);

    return $mysqlObj;
}


?>
<?php 
require_once("include.php");

//gui functions

function drawFileDropDown() {
    
}

function drawEditDropDown() {
    
}

function drawFontDropDown($mysqlObj)
{
    // Prepare SQL statement
    $TableName = "fontNames";
    $query = "Select * from $TableName";
    $stmtObj = $mysqlObj->prepare($query);

    // Binds then executes sql statement
    $BindSuccess = $stmtObj->bind_result($font);
    if ($BindSuccess)
        $success = $stmtObj->execute();
    else
        echo "Bind failed: " . $stmtObj->error;

    // Create dropdown box, on change calls js function "SetFont"
    echo "<select id = \"fonts\" onChange = \"SetFont()\">";

    // Fetch gets all fonts and adds them as options in the drop down box
    while ($stmtObj->fetch())
        echo "<option value = \"$font\">$font</option>";
    echo "</select>";

    // Dropdown box for font size, on change calls js function "SetSize
    echo "<select id = \"sizes\" size = \"3\" onChange = \"SetSize()\">
        <option value = \"small\">Small</option>
        <option value = \"medium\">Medium</option>
        <option value = \"large\">Large</option>
        </select>";
    
    // Testing purposes only, remove later.
    echo "<br><input type = input name = \"goop\" Size = 30 value = \"Testing\" id = \"test\">";
}

function drawMenu($mysqlObj) {

    echo "<form action=\"?\" type=\"post\">";
    echo "<div class=\"menu\">";
    drawEditDropDown();
    drawFileDropDown();
    drawFontDropDown($mysqlObj);
    echo "</div>";
    echo "</form>";

    DisplayLabel("Write your text here!");
    DisplayTextbox("textarea", "body", 500, "Start writing here");
}

//save and open file functions
function saveFile($body) {

    try {

        $fs = fopen("editor.dat", "w");
        $exists = file_exists($fs);

        if (!$exists) {
            throw new Exception("Editor.dat does not exist", 22);
        }

        $outcome = fwrite($fs, $body);
        
        if (!$outcome) {
            throw new Exception("Error Saving file", 25);
        }
        else {
            echo "<p>File saved</p>";
        }
    }

    catch(Exception $ex)  {
        $message = $ex->getMessage();
        $code = $ex->getCode();

        echo "<p>$message $code";
    }
    
}

function openFile() {

    try {

        $fs = fopen("editor.dat", "r");
        $exists = file_exists($fs);

        if (!$exists) {
            throw new Exception("Editor.dat does not exist", 22);
        }

        $body = trim(fread($fs, 500));
    
        if (!$body) {
            throw new Exception("Error opening file", 25);
        }
        else {
            echo "<p>File opened</p>";
        }
    }

    catch(Exception $ex)  {
        $message = $ex->getMessage();
        $code = $ex->getCode();

        echo "<p>$message $code";
    }
    
    return $body;
}



//main
//$mysqlObj = CreateConnectionObject();
$TableName = "fontNames";
//write headers with all student first and last names
WriteHeaders("PHP group Project", "By: Sam Marrello, Emma Lavigne, Fidy Fiaferana, Jordan Lo Monico, Logan Finches, & Drew Murray");
//if (isset($_POST['f_Save']))saveFile($p));
// else if openFile();
//  else if findButton, findTextInFile($p1, $p2);
//else drawMenu();
if (isset($mysqlObj)) $mysqlObj->close();
//write footers
WriteFooters();
?>

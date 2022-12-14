<?php 
require_once("include.php");

//gui functions

function drawFileDropDown() {
    echo "<select name=\"edit\" id=\"edit\"";
    echo "<option value=\"new\">"; 
    DisplayButton("new", "New");
    echo "</option>";
    echo "<option value=\"save\">"; 
    DisplayButton("save", "Save");
    echo "</option>";
    echo "<option value=\"open\">"; 
    DisplayButton("open", "Open");
    echo "</option>";
    echo "</select>";
}

function drawEditDropDown() {
    DisplayLabel("Find");
    DisplayTextbox("text", "search", 55, "Search");
    DisplayLabel("Case sensitive?");
    DisplayTextbox("checkbox", "caseSensitive", 55, "Case Sensitive");
    DisplayButton("edit", "Done");
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

function drawMenu($mysqlObj, $body = "") {

    if (!isset($body)) {
        $body = "Enter your text here";
    }

    echo "<form action=? type=post>";
    echo "<div class=\"menu\">";
    drawEditDropDown();
    drawFileDropDown();
    drawFontDropDown($mysqlObj);
    echo "</div>";
    echo "</form>";

    DisplayLabel("Write your text here!");
    DisplayTextbox("textarea", $body, 500, "Start writing here");
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

function findTextInFile($sourceText, $targetString)
{
    $outputString = ("String " . $targetString . " was not found.");
    $foundString = ($targetString . " was found at position ");
    if (isset($_POST['caseSensitive']))
        $pos = strpos($sourceText, $targetString);
    else
        $pos = stripos($sourceText, $targetString);
    if($pos !== false)
    $outputString = $foundString . ($pos + 1);
    return $outputString;
}


//main
$mysqlObj = CreateConnectionObject();
$TableName = "fontNames";
//write headers with all student first and last names
WriteHeaders("PHP group Project", "By: Sam Marrello, Emma Lavigne, Fidy Fiaferana,
                Jordan Do Canto, Logan Finches, & Drew Murray");
if (isset($_POST['save'])) saveFile($body);
    else if (isset($_POST['open']))
    {
        $body = openFile();
        
    }
        else if (isset($_POST['find']))
        {    
            $foundOutput = findTextInFile($p1, $p2);
            echo $foundOutput;
        }
            else drawMenu($mysqlObj);
if (isset($mysqlObj)) $mysqlObj->close();
//write footers
WriteFooters();
?>

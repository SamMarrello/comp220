function SetFont()
{
    // Getting chosen font from the drop down box when its selected
    let chosenFont = document.getElementById("fonts").value;
    // Changes text to be in the chosen font
    // NOTE: CHANGE textbox ID
    document.getElementById("body").style.fontFamily = chosenFont;
}

function SetSize()
{
    // Getting chosen font size from the drop down box when its selected
    let chosenSize = document.getElementById("sizes").value;
    // Changes text size to be in the chosen size
    // NOTE: CHANGE textbox ID
    document.getElementById("body").style.fontSize = chosenSize;
}
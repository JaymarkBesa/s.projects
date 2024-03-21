document.getElementById("signinButton").addEventListener("click", function() {
    // Create a new anchor element
    var anchor = document.createElement("a");
    // Set the href attribute to login.php
    anchor.href = "login.php";
    // Set the target attribute to "_blank" to open in a new tab
    anchor.target = "_blank";
    // Append the anchor element to the document body (this step is necessary for some browsers)
    document.body.appendChild(anchor);
    // Trigger a click event on the anchor element to open login.php in a new tab
    anchor.click();
    // Remove the anchor element from the document body (optional)
    document.body.removeChild(anchor);
});
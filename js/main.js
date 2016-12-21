/*------------------------------------------------------------------------------
Global variables
------------------------------------------------------------------------------*/



/*------------------------------------------------------------------------------
Add Event Listeners to necessary pages and elements upon DOM loading
------------------------------------------------------------------------------*/


/*------------------------------------------------------------------------------
JS function calls
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
function 1
------------------------------------------------------*/


/*-----------------------------------------------------
function 2
------------------------------------------------------*/


/*-----------------------------------------------------
function 3
------------------------------------------------------*/



/*------------------------------------------------------------------------------
AJAX helper function
------------------------------------------------------------------------------*/
function ajax(url, callback) {
  url = "https://ista416.000webhostapp.com/server.php?" + url;

  // Create a new XMLHttpRequest Object
  var req = new XMLHttpRequest();

  // Pass Cookie Credentials along with request
  req.withCredentials = true;

  // Create a callback function when the State of the Connection changes
  req.onreadystatechange = function() {
    if (req.readyState == 4)       // state of 4 is 'done'. The request has completed
    {
      callback( JSON.parse(req.responseText) );  // The .responseText property of the request object
    } else {                                     // contains the Text returned from the request.
      // console.log(req.readyState);
    }
  };

  // Set up our HTTP Request
  req.open('GET', url, true);

  // Finally initiate the request
  req.send();

}

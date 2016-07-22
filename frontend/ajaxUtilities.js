/**
 * Encapsulates an AJAX post request to the given url.
 * An ampersand delimited list of query parameters can
 * be specified in queryString. The onResponse callback
 * will be fired when the request provides a response.
 */
function sendPostRequest(url, queryString, onResponse) {
    var postRequest = new XMLHttpRequest();
    postRequest.open("POST", url, true);
    postRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    postRequest.onreadystatechange = onResponse;
    postRequest.send(queryString);
}

/**
 *
 */
function createQueryParametersString(queryObject) {
    var queryString = "";
    var keys = Object.keys(queryObject);
    for (var i = 0; i < keys.length; i++) {
        var key = keys[i];
        var value = queryObject[key];
        queryString += key + "=" + value + "&";
    }
    return queryString;
}
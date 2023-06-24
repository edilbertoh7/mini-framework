const saludar = () => { 
    aler('Hola mundo');
    
var objXMLHttpRequest = new XMLHttpRequest();
objXMLHttpRequest.onreadystatechange = function() {
  if(objXMLHttpRequest.readyState === 4) {
    if(objXMLHttpRequest.status === 200) {
          alert(objXMLHttpRequest.responseText);
    } else {
          alert('Error Code: ' +  objXMLHttpRequest.status);
          alert('Error Message: ' + objXMLHttpRequest.statusText);
    }
  }
}
objXMLHttpRequest.open('GET', 'http://udemy-mvc.test:8081/persona/3');
objXMLHttpRequest.send();

}
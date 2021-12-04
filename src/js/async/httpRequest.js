export function createRecuest(metod, url, callback) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4) {
        callback(this);
      }
    };
    xmlhttp.open(metod, url, true);
    xmlhttp.send();
}
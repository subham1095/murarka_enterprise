function start_watch() {
var time = new Date();
var hours = time.getHours();
var min = time.getMinutes();
var sec = time.getSeconds();
hours=addZero(hours);
min=addZero(min);
sec=addZero(sec);
document.getElementById('watch').innerHTML=hours + ":" + min + "" + sec;
watch = setTimeout("start_watch()",1000);
}

// function addZero {
// if (x<10) x = "0"+x;
// return x;
// }
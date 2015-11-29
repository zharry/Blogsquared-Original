function pageload() {
document.getElementById('Show').style.display='none';
document.getElementById('Admin_Section').style.display='none';
}
function hide() {
document.getElementById('Hide').style.display='none';
document.getElementById('Show').style.display='';
}
function show() {
document.getElementById('Hide').style.display='';
document.getElementById('Show').style.display='none';
}
function showadmin() {
document.getElementById('Admin_Section').style.display='';
document.getElementById('Admin_ShowHide_Button').innerHTML='<button onclick="hideadmin()">Hide Admin Panel</button>';
}
function hideadmin() {
document.getElementById('Admin_Section').style.display='none';
document.getElementById('Admin_ShowHide_Button').innerHTML='<button onclick="showadmin()">Show Admin Panel</button>';
}
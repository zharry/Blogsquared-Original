function changeBold() {
document.getElementById('change_bold').innerHTML='<input type="button" value="</b>" onclick="func2()" />';
}
function revertBold() {
document.getElementById('change_bold').innerHTML='<input type="button" value="<b>" onclick="func1()" />';
}
function changeItalics() {
document.getElementById('change_italics').innerHTML='<input type="button" value="</i>" onclick="func4()" />';
}
function revertItalics() {
document.getElementById('change_italics').innerHTML='<input type="button" value="<i>" onclick="func3()" />';
}
function changeUnderline() {
document.getElementById('change_underline').innerHTML='<input type="button" value="</u>" onclick="func6()" />';
}
function revertUnderline() {
document.getElementById('change_underline').innerHTML='<input type="button" value="<u>" onclick="func5()" />';
}
const advSearch = document.getElementById('advanced');
const checkedSearch = document.getElementById('nextMonth');
function advancedChecked(){
    if(checkedSearch.checked != true){
        advSearch.className = 'default';
    }else{
        advSearch.className = '';
    }
}
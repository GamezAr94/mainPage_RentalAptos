const advSearch = document.getElementById('advanced');
const checkedSearch = document.getElementById('nextMonth');
//method to hidde the advanced search tool
function advancedChecked(){
    if(checkedSearch.checked != true){
        advSearch.className = 'default';
    }else{
        advSearch.className = '';
    }
}
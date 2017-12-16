document.addEventListener("DOMContentLoaded", function () {
    let monthForm = document.getElementById('monthForm');
    let yearForm = document.getElementById('yearForm');
    let dayForm = document.getElementById('dayForm');

    what.addEventListener('change', function () {
        changeDisplay(monthForm, 'month');
        changeDisplay(yearForm, 'year');
        changeDisplay(dayForm, 'day');
    });

    function changeDisplay(id, stringOfId) {
        let what = document.getElementById('what');

        if (what.value == stringOfId) {
            id.style.display = 'block';
        } else {
            id.style.display = 'none';
        }
    }
});
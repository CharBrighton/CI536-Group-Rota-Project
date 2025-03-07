window.addEventListener('load', function (evt) {

    const day = new Date();
    const day_num = day.getDay();
    const day_month = day.getMonth();
    document.getElementById(day_num).style.backgroundColor = "yellow";
    const month_strings = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    document.getElementById('month').textContent = month_strings[day_month];

    if(day_num == 1) {
        document.getElementById('mon_date').textContent = day.getDate();
        document.getElementById('tue_date').textContent = day.getDate() + 1;
        document.getElementById('wed_date').textContent = day.getDate() + 2;
        document.getElementById('thu_date').textContent = day.getDate() + 3;
        document.getElementById('fri_date').textContent = day.getDate() + 4;
        document.getElementById('sat_date').textContent = day.getDate() + 5;
        document.getElementById('sun_date').textContent = day.getDate() + 6;
    }
    if(day_num == 2) {
        document.getElementById('mon_date').textContent = day.getDate() -1;
        document.getElementById('tue_date').textContent = day.getDate();
        document.getElementById('wed_date').textContent = day.getDate() + 1;
        document.getElementById('thu_date').textContent = day.getDate() + 2;
        document.getElementById('fri_date').textContent = day.getDate() + 3;
        document.getElementById('sat_date').textContent = day.getDate() + 4;
        document.getElementById('sun_date').textContent = day.getDate() + 5;
    }
    if(day_num == 3) {
        document.getElementById('mon_date').textContent = day.getDate() - 2;
        document.getElementById('tue_date').textContent = day.getDate() - 1;
        document.getElementById('wed_date').textContent = day.getDate();
        document.getElementById('thu_date').textContent = day.getDate() + 1;
        document.getElementById('fri_date').textContent = day.getDate() + 2;
        document.getElementById('sat_date').textContent = day.getDate() + 1;
        document.getElementById('sun_date').textContent = day.getDate() + 2;
    }
    if(day_num == 4) {
        document.getElementById('mon_date').textContent = day.getDate() - 3;
        document.getElementById('tue_date').textContent = day.getDate() - 2;
        document.getElementById('wed_date').textContent = day.getDate() - 1;
        document.getElementById('thu_date').textContent = day.getDate();
        document.getElementById('fri_date').textContent = day.getDate() + 1;
        document.getElementById('sat_date').textContent = day.getDate() + 2;
        document.getElementById('sun_date').textContent = day.getDate() + 3;
    }
    if(day_num == 5) {
        document.getElementById('mon_date').textContent = day.getDate() - 4;
        document.getElementById('tue_date').textContent = day.getDate() - 3;
        document.getElementById('wed_date').textContent = day.getDate() - 2;
        document.getElementById('thu_date').textContent = day.getDate() - 1;
        document.getElementById('fri_date').textContent = day.getDate();
        document.getElementById('sat_date').textContent = day.getDate() + 1;
        document.getElementById('sun_date').textContent = day.getDate() + 2;
    }
    if(day_num == 6) {
        document.getElementById('mon_date').textContent = day.getDate() - 5;
        document.getElementById('tue_date').textContent = day.getDate() - 4;
        document.getElementById('wed_date').textContent = day.getDate() - 3;
        document.getElementById('thu_date').textContent = day.getDate() - 2;
        document.getElementById('fri_date').textContent = day.getDate() - 1;
        document.getElementById('sat_date').textContent = day.getDate();
        document.getElementById('sun_date').textContent = day.getDate() + 1;
    }
    if(day_num == 7) {
        document.getElementById('mon_date').textContent = day.getDate() - 6;
        document.getElementById('tue_date').textContent = day.getDate() - 5;
        document.getElementById('wed_date').textContent = day.getDate() - 4;
        document.getElementById('thu_date').textContent = day.getDate() - 3;
        document.getElementById('fri_date').textContent = day.getDate() - 2;
        document.getElementById('sat_date').textContent = day.getDate() - 1;
        document.getElementById('sun_date').textContent = day.getDate();
    }
});
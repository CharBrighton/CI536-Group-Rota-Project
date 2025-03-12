window.addEventListener('load', function (evt) {

    const day = new Date();
    const day_num = day.getDay();
    const today_date = day.getDate();

    console.log(today_date);

    console.log(day.setDate(13))                                    ;
    const day_month = day.getMonth();
    const day_year = day.getFullYear();

    console.log(day_year,day_month+1,day_num);
    document.getElementById(day_num).style.backgroundColor = "yellow";
    const month_strings = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    document.getElementById('month').textContent = month_strings[day_month];

    const day_names = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
    document.getElementById(day_names[day_num-1]+'_date').textContent =  today_date;

});
window.addEventListener('load', function (evt) {
    const day = new Date();
    let modifier = 0;
    rotadates();

    //prev button -7 from all dates
    this.document.querySelector('#prev').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = modifier - 7;
        rotadates();
    });

    //next button adds 7 to all dates
    this.document.querySelector('#next').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = modifier + 7;
        rotadates();
    });

    //today button sets modifier to 0
    this.document.querySelector('#today').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = 0;
        rotadates();
    });

    //add Month Year above the days
    function monthtext(date) {
        const month_strings = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        return month_strings[date];
    }

    function rotadates() {

        const year = day.getFullYear();

        function firstDateOftheWeek() {
            const today = new Date();
            console.log("Line 47: TODAY "+today);
            const dayOfWeek = today.getDay();
            const mostRecentMonday = new Date(today);
            mostRecentMonday.setDate(today.getDate() - (dayOfWeek === 0 ? 6 : dayOfWeek - 1));

            const day_names = ["monday","tuesday","wednesday","thursday","friday","saturday","sunday"];
            let dayid = day_names[dayOfWeek-1]
            if(modifier == 0){
                highlight(dayid);
            }
            else{
                unhighlight(dayid);
            }


            return mostRecentMonday;
        }

        console.log("Line 65: "+firstDateOftheWeek());


        function highlight(dayid) {
            document.getElementById(dayid).style.backgroundColor = "yellow";
        }
        function unhighlight(dayid) {
            document.getElementById(dayid).style.removeProperty('background-color');
        }

        const fdotsS = String(firstDateOftheWeek());
        const day_date = fdotsS.slice(8, 10);

        //creating YYYY-MM-DD Version of the mondays date
        let month = day.getMonth();
        const month_num = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
        let mon_date = year + "-" + month_num[month] + "-" + day_date;

        //adding dates to days of the week
        let monday = new Date(mon_date);
        monday.setDate(monday.getDate() + modifier);
        document.getElementById('Mon_date').textContent = String(monday).slice(7, 10) + " " + String(monday).slice(4, 7) + " " + String(monday).slice(10, 15);

        let tuesday = new Date(mon_date);
        tuesday.setDate(tuesday.getDate() + modifier + 1);
        console.log(tuesday);
        document.getElementById('Tue_date').textContent = String(tuesday).slice(7, 10) + " " + String(tuesday).slice(4, 7) + " " + String(tuesday).slice(10, 15);

        let wednesday = new Date(mon_date);
        wednesday.setDate(wednesday.getDate() + modifier + 2);
        document.getElementById('Wed_date').textContent = String(wednesday).slice(7, 10) + " " + String(wednesday).slice(4, 7) + " " + String(wednesday).slice(10, 15);

        let thursday = new Date(mon_date);
        thursday.setDate(thursday.getDate() + modifier + 3);
        document.getElementById('Thu_date').textContent = String(thursday).slice(7, 10) + " " + String(thursday).slice(4, 7) + " " + String(thursday).slice(10, 15);

        let friday = new Date(mon_date);
        friday.setDate(friday.getDate() + modifier + 4);
        document.getElementById('Fri_date').textContent = String(friday).slice(7, 10) + " " + String(friday).slice(4, 7) + " " + String(friday).slice(10, 15);

        let saturday = new Date(mon_date);
        saturday.setDate(saturday.getDate() + modifier + 5);
        document.getElementById('Sat_date').textContent = String(saturday).slice(7, 10) + " " + String(saturday).slice(4, 7) + " " + String(saturday).slice(10, 15);

        let sunday = new Date(mon_date);
        sunday.setDate(sunday.getDate() + modifier + 6);;
        document.getElementById('Sun_date').textContent = String(sunday).slice(7, 10) + " " + String(sunday).slice(4, 7) + " " + String(sunday).slice(10, 15);
    }

});
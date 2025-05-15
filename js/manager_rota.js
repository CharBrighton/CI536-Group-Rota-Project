window.addEventListener('load', function (evt) {
    const day = new Date();
    let modifier = 0;
    rotadates();
    getdbshifts();

    //prev button -7 from all dates
    this.document.querySelector('#prev').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = modifier - 7;
        rotadates();
        getdbshifts();
    });

    //next button adds 7 to all dates
    this.document.querySelector('#next').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = modifier + 7;
        rotadates();
        getdbshifts();
    });

    //today button sets modifier to 0
    this.document.querySelector('#today').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = 0;
        rotadates();
        getdbshifts();
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

            let dayid = 0;
            if(dayOfWeek === 0){
                dayid = 7;
            }
            else{
                dayid = day_names[dayOfWeek-1]
            }

            if(modifier == 0){
                highlight(dayid);
            }
            else{
                unhighlight(dayid);
            }


            return mostRecentMonday;
        }
        function highlight(dayid) {
            document.getElementById(dayid).style.backgroundColor = "#0D6EFD";
        }
        function unhighlight(dayid) {
            document.getElementById(dayid).style.removeProperty('background-color');
        }

        const fdotsS = String(firstDateOftheWeek());
        console.log("Line 78: "+fdotsS);
        const day_date = fdotsS.slice(8, 10);

        //creating YYYY-MM-DD Version of the mondays date
        let month = day.getMonth();
        const month_num = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
        let mon_date = year + "-" + month_num[month] + "-" + day_date;

        //adding dates to days of the week
        let monday = new Date(mon_date);
        monday.setDate(monday.getDate() + modifier);
        let m = document.getElementById('Mon_date');
        m.textContent = String(monday).slice(7, 10) + " " + String(monday).slice(4, 7) + " " + String(monday).slice(10, 15);
        m.setAttribute('data-value',monday.toISOString().split('T')[0]);


        let tuesday = new Date(mon_date);
        tuesday.setDate(tuesday.getDate() + modifier + 1);
        let t = document.getElementById('Tue_date');
        t.textContent = String(tuesday).slice(7, 10) + " " + String(tuesday).slice(4, 7) + " " + String(tuesday).slice(10, 15);
        t.setAttribute('data-value',tuesday.toISOString().split('T')[0]);

        let wednesday = new Date(mon_date);
        wednesday.setDate(wednesday.getDate() + modifier + 2);
        let w = document.getElementById('Wed_date');
        w.textContent = String(wednesday).slice(7, 10) + " " + String(wednesday).slice(4, 7) + " " + String(wednesday).slice(10, 15);
        w.setAttribute('data-value',wednesday.toISOString().split('T')[0]);

        let thursday = new Date(mon_date);
        thursday.setDate(thursday.getDate() + modifier + 3);
        let th = document.getElementById('Thu_date');
        th.textContent = String(thursday).slice(7, 10) + " " + String(thursday).slice(4, 7) + " " + String(thursday).slice(10, 15);
        th.setAttribute('data-value',thursday.toISOString().split('T')[0]);

        let friday = new Date(mon_date);
        friday.setDate(friday.getDate() + modifier + 4);
        let f = document.getElementById('Fri_date');
        f.textContent = String(friday).slice(7, 10) + " " + String(friday).slice(4, 7) + " " + String(friday).slice(10, 15);
        f.setAttribute('data-value',friday.toISOString().split('T')[0]);

        let saturday = new Date(mon_date);
        saturday.setDate(saturday.getDate() + modifier + 5);
        let sa = document.getElementById('Sat_date');
        sa.textContent = String(saturday).slice(7, 10) + " " + String(saturday).slice(4, 7) + " " + String(saturday).slice(10, 15);
        sa.setAttribute('data-value',saturday.toISOString().split('T')[0]);

        let sunday = new Date(mon_date);
        sunday.setDate(sunday.getDate() + modifier + 6);
        let su = document.getElementById('Sun_date');
        su.textContent = String(sunday).slice(7, 10) + " " + String(sunday).slice(4, 7) + " " + String(sunday).slice(10, 15);
        su.setAttribute('data-value',sunday.toISOString().split('T')[0]);
    }

});
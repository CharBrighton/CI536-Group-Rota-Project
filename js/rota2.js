window.addEventListener('load', function (evt) {
    let modifier = 0;
    rotadates();

    this.document.querySelector('#prev').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = modifier - 7;
        rotadates();
    });

    this.document.querySelector('#next').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = modifier + 7;
        rotadates();
    });

    this.document.querySelector('#today').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = 0;
        rotadates();
    });

    function rotadates() {
        let day = new Date();

        const year = day.getFullYear();

        function firstDateOftheWeek() {
            const today = new Date();
            const dayOfWeek = today.getDay();
            const mostRecentMonday = new Date(today);
            mostRecentMonday.setDate(today.getDate() - (dayOfWeek === 0 ? 6 : dayOfWeek - 1));
            return mostRecentMonday;
        }

        console.log(firstDateOftheWeek());

        const fdotsS = String(firstDateOftheWeek());
        const short_day_letter = fdotsS.slice(0, 3);
        const day_date = fdotsS.slice(8, 10);
        console.log(short_day_letter);

        let month = day.getMonth();
        const month_num = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
        let today_date = year + "-" + month_num[month] + "-" + day_date;

        console.log(year + "-" + month_num[month] + "-" + day_date)

        let monday = new Date(today_date);
        monday.setDate(monday.getDate() + modifier);
        console.log(monday);
        document.getElementById('Mon_date').textContent = String(monday).slice(7, 10);

        let tuesday = new Date(today_date);
        tuesday.setDate(tuesday.getDate() + modifier + 1);
        console.log(tuesday);
        document.getElementById('Tue_date').textContent = String(tuesday).slice(7, 10);

        let wednesday = new Date(today_date);
        wednesday.setDate(wednesday.getDate() + modifier + 2);
        console.log(wednesday);
        document.getElementById('Wed_date').textContent = String(wednesday).slice(7, 10);

        let thursday = new Date(today_date);
        thursday.setDate(thursday.getDate() + modifier + 3);
        console.log(thursday);
        document.getElementById('Thu_date').textContent = String(thursday).slice(7, 10);

        let friday = new Date(today_date);
        friday.setDate(friday.getDate() + modifier + 4);
        console.log(friday);
        document.getElementById('Fri_date').textContent = String(friday).slice(7, 10);

        let saturday = new Date(today_date);
        saturday.setDate(saturday.getDate() + modifier + 5);
        console.log(saturday);
        document.getElementById('Sat_date').textContent = String(saturday).slice(7, 10);

        let sunday = new Date(today_date);
        sunday.setDate(sunday.getDate() + modifier + 6);
        console.log(sunday);
        document.getElementById('Sun_date').textContent = String(sunday).slice(7, 10);
    }

});
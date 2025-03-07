window.addEventListener('load', function (evt) {

    this.document.querySelector('#submit_person').addEventListener('click', async function (evt) {
        evt.preventDefault();
        console.log("SUBMITTED");

        const name = document.getElementById("names").value;
        const day = document.getElementById('days').value;

        console.log(name);
        console.log(day);

        let card_name = day + "_card";
        const card = document.getElementById(card_name);

        console.log(card);

        const name_add = document.createElement('p');
        name_add.textContent = name;
        card.appendChild(name_add);

    })

})
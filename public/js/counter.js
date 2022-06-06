// const count = document.getElementById("count");
let value;
const counter = document.querySelector("#counter");
const count2s = document.querySelectorAll("#count2");

function updateVisitCount() {
    fetch("https://api.countapi.xyz/update/phonestl/website/?amount=1")
        .then(res => res.json())
        .then(data => {
            value = 36400 + data.value;
            // count.innerText = value;

            counter.setAttribute('data-target', `${value}`)
            let target = +counter.getAttribute('data-target');
            const updateCounter = () => {
                const c = +counter.innerText;
                const increment = target / 100;
                if (c <= target) {
                    counter.innerText = Math.ceil(c + increment);
                    setTimeout(updateCounter, 20)
                }
            }
            updateCounter();
        })
}

updateVisitCount();

count2s.forEach(count2 => {
    count2.innerText = '0';

    const update = () => {
        const target2 = +count2.getAttribute('data-target2');
        const c2 = +count2.innerText;

        const increment2 = target2 / 200;

        if (c2 < target2) {
            count2.innerText = Math.ceil(c2 + increment2);
            setTimeout(update, 25)
        }
    }
    update();
})
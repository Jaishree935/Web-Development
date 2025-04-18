let url = "https://api.genderize.io?name=";
let wrapper = document.getElementById("wrapper");

let predictGender = () => {
    let nameValue = document.getElementById("name").value.trim();
    let error = document.getElementById("error");
    let finalURL = url + nameValue;
    wrapper.innerHTML = ""; // Clear previous results

    if (nameValue.length > 0 && /^[A-Za-z]+$/.test(nameValue)) {
        fetch(finalURL)
        .then(resp => resp.json())
        .then(data => {
            console.log(data);

            if (!data.gender) {
                error.innerHTML = "Could not predict gender for this name.";
                return;
            }

            let div = document.createElement("div");
            div.setAttribute("id", "info");

            let img = document.createElement("img");
            img.setAttribute("id", "gender-icon");

            div.innerHTML = `
                <h2 id="result-name">${data.name}</h2>
                <h1 id="gender">${data.gender}</h1>
                <h4 id="prob">Probability: ${data.probability}</h4>
            `;

            if (data.gender == "female") {
                div.classList.add("female");
                img.setAttribute("src", "female.png");
            } else {
                div.classList.add("male");
                img.setAttribute("src", "male.png");
            }

            div.appendChild(img);
            wrapper.appendChild(div);
        });

        document.getElementById("name").value = "";
        error.innerHTML = "";
    } else {
        error.innerHTML = "Enter a valid name with no space";
    }
};

document.getElementById("submit").addEventListener("click", predictGender);

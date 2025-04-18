//GPA Calculator
function generateFields() {
    let count = document.getElementById("subjectCount").value;
    let container = document.getElementById("subjectInputs");
    container.innerHTML = ""; // Clear previous fields

    if (count <= 0 || isNaN(count)) {
        alert("Enter a valid number of subjects.");
        return;
    }

    // Create Table
    let table = document.createElement("table");
    table.border = "1";

    // Table Header
    let thead = document.createElement("thead");
    let headerRow = document.createElement("tr");

    let headers = ["Subject Name", "Grade", "Credit"];
    headers.forEach(headerText => {
        let th = document.createElement("th");
        th.innerText = headerText;
        headerRow.appendChild(th);
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    // Table Body
    let tbody = document.createElement("tbody");

    for (let i = 1; i <= count; i++) {
        let row = document.createElement("tr");

        // Subject Name Input
        let subjectCell = document.createElement("td");
        let subjectInput = document.createElement("input");
        subjectInput.type = "text";
        subjectInput.placeholder = "Enter Subject Name";
        subjectInput.className = "subject-name";
        subjectCell.appendChild(subjectInput);

        // Grade Input (Dropdown)
        let gradeCell = document.createElement("td");
        let gradeSelect = document.createElement("select");
        gradeSelect.className = "subject-grade";

        let grades = ["O", "A+", "A", "B+", "B", "C", "F"];
        grades.forEach(grade => {
            let option = document.createElement("option");
            option.value = grade;
            option.innerText = grade;
            gradeSelect.appendChild(option);
        });

        gradeCell.appendChild(gradeSelect);

        // Credit Input
        let creditCell = document.createElement("td");
        let creditInput = document.createElement("input");
        creditInput.type = "number";
        creditInput.placeholder = "Enter Credit";
        creditInput.className = "subject-credit";
        creditCell.appendChild(creditInput);

        // Append cells to row
        row.appendChild(subjectCell);
        row.appendChild(gradeCell);
        row.appendChild(creditCell);

        // Append row to table body
        tbody.appendChild(row);
    }

    table.appendChild(tbody);
    container.appendChild(table);
}

// Function to Convert Letter Grades to Numeric Values
function getGradePoints(grade) {
    let gradePoints = {
        "O": 10,
        "A+": 9,
        "A": 8,
        "B+": 7,
        "B": 6,
        "C": 5,
        "F": 0
    };
    return gradePoints[grade] || 0; // Default to 0 if invalid
}

// Function to Calculate GPA
function calculategpa() {
    let grades = document.getElementsByClassName("subject-grade");
    let credits = document.getElementsByClassName("subject-credit");

    let totalCredits = 0;
    let weightedSum = 0;

    for (let i = 0; i < grades.length; i++) {
        let grade = grades[i].value; // Get selected grade
        let credit = parseFloat(credits[i].value);
        
        if (!isNaN(credit)) {
            let gradePoint = getGradePoints(grade);
            weightedSum += gradePoint * credit;
            totalCredits += credit;
        }
    }

    if (totalCredits > 0) {
        let gpa = weightedSum / totalCredits;
        document.getElementById("gpaResult").innerText = "Your GPA: " + gpa.toFixed(2);
    } else {
        document.getElementById("gpaResult").innerText = "Invalid Input!";
    }
}

//CGPA Calculator
 function generateSemesterFields(){
    let num=document.getElementById("numSemesters").value;
    let container=document.getElementById("semesterInputs");
    container.innerHTML="";
    if(num<=0 || isNaN(num)){
        alert("Enter a valid number of semesters.");
        return ;
    }
    for(let i=1;i<=num;i++){
        let label=document.createElement("label");
        label.innerText=`Semester ${i} GPA:`;
        let input=document.createElement("input");
        input.type="integer";
        input.id=`sem${i}`;
        input.className="semester-gpa";
        input.placeholder="Enter GPA";
        container.appendChild(label);
        container.appendChild(input);
        container.appendChild(document.createElement("br"));
    } 
 }
function calculateCGPA(){
    let gpaInputs=document.getElementsByClassName("semester-gpa");
    let totalGPA=0;
    let semesterCount=0;
    for(let i=0;i<gpaInputs.length;i++){
        let gpa=parseFloat(gpaInputs[i].value);
        if(!isNaN(gpa) && gpa>=0 && gpa<=10){
            totalGPA+=gpa;
            semesterCount++;
        }
        else{
            alert("Enter valid GPA score");
            return ;
        }
    }
    if(semesterCount>0){
        let cgpa=totalGPA/semesterCount;
        document.getElementById("cgpaResult").innerText="Your CGPA: "+cgpa.toFixed(2);
    }
    else{
        document.getElementById("cgpaResult").innerText="Invalid Input";
    }
}
function resetCGPA(){
    document.getElementById("semesterInputs").innerHTML="";
    document.getElementById("numSemesters").value="";
    document.getElementById("cgpaResult").innerText="";
}
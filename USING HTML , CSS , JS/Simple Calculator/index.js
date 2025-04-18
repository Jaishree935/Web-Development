const display=document.getElementById("display")

function appendToDisplay(input){
     if(display.value === "0" || display.value === "Error"){
        display.value = input;
     }
     else{
        display.value+=input;
     }
}
function clearDisplay(){
    display.value="0";
}
function calculateResult(){
    try{
    display.value=eval(display.value)
    }
    catch{
        display.value="Error"
    }
}
function clearLastElement(){
    display.value=display.value.slice(0,-1);
    if(display.value==="0"){
        display.value="0";
    }
}
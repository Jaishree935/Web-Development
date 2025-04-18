const container=document.querySelector('.container');
const btns=document.querySelectorAll('.btn') /* btns nu class erukrua ela elements su eduthutu va */

const imgList=["1","2","3","4"]; //images name 

let index=0;//for track the image
btns.forEach((button)=>{
    button.addEventListener('click',()=>{
      if(button.classList.contains('btn-left')){
             index--;
             if(index<0){
                index=imgList.length-1;
             }
             container.style.background=` url('Imgs/${imgList[index]}.jpg') center/cover fixed no-repeat`
      }
      else{
          index++;
          if(index===imgList.length-1){
            index=0;
          }
          container.style.background=` url('Imgs/${imgList[index]}.jpg') center/cover fixed no-repeat`
      }
    })
})
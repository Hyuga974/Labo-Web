const My_Title="Square";

document.title=My_Title;


let nbSquare=0;

let addSquare=function(){
    const container=document.getElementById('container');
    for (let i=0; i<4; i++){
        nbSquare++;
        let square = document.createElement('div');
        square.className = 'square';
        square.id = 'square-'+i;
        square.style.backgroundColor = "#" + ((1<<24)*Math.random() | 0).toString(16);
        container.appendChild(square);
        console.log('Here')
    }
}

let changeColorSquare=function(){
    let allSquares = document.querySelectorAll(".square")
    allSquares.forEach(square =>{
        square.style.backgroundColor = "#" + ((1<<24)*Math.random() | 0).toString(16)
    })
}

let removeSquares=function(){
    let allSquares = document.querySelectorAll(".square")
    allSquares.forEach(square =>{
        square.remove();
    })
}



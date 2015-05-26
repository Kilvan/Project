


var Direction = {
    RIGHT : 0,
    DOWN : 1,
    LEFT : 2,
    UP : 3,
    
    toString : function(direction) {
        var texts = ["right", "down", "left", "up"];
        return texts[direction];
    }
};


/**
 * @param {Element} div          Div to be styled.
 * @param {int} width            New width for div.
 * @param {int} height           New height for div.
 * @param {int} top              New top for div.
 * @param {int} left             New left for  div.
 * @param {Direction} direction  Direction that the div is pointing at.
 * @param {string} text          text will be displayed by div.
 * @returns {Element}            Div that was passed, but with styling.
 */
function pleaseStyleMyDiv(div, width, height, top, left, direction, text) 
{    
    div.style.width  = width  + "px";
    div.style.height = height + "px";
    div.style.top    = top    + "px";
    div.style.left   = left   + "px";
    div.innerHTML    = text;
    div.className    = "box " + Direction.toString(direction);
    return div;
}

/**
 * Inserts multiple Div DOMElements to the #content DOMElement.
 * @param {type} width       Number of horizontal divs
 * @param {type} height      Number of vertical divs
 * @param {type} boardWidth  Width of the board
 * @param {type} boardHeight Height of the board
 * @returns {undefined}      
 */
function DrawBoard(width, height, boardWidth, boardHeight)
{
    content.innerHTML = ""; // clear all previous divs
    
    var 
        step = 0, 
        squareCount = width * height,
        fieldWidth = Math.floor(boardWidth / width),
        fieldHeight = Math.floor(boardHeight / height)
    ;
    
    boardWidth = fieldWidth * width;
    boardHeight = fieldHeight * height;

    for(var i = 0, left = 0, tops = 0, direction = Direction.RIGHT; i < squareCount; i++)
    {
        var div = document.createElement("div");
        content.appendChild( pleaseStyleMyDiv(div, fieldWidth, fieldHeight, tops, left, direction, i) );
        
        switch (direction)
        {   
            case Direction.RIGHT:
                left += fieldWidth;    
                if(left === boardWidth - fieldWidth - step * fieldWidth)
                {
                    direction = Direction.DOWN;  
                }
                break;

            case Direction.DOWN:
                tops += fieldHeight;
                if(tops === boardHeight - fieldHeight- step * fieldHeight)
                {
                    direction = Direction.LEFT; 
                }
                break;

            case Direction.LEFT:
                left -= fieldWidth;
                if(left === 0  + step * fieldWidth )
                {
                    direction = Direction.UP;
                }        
                break;

            case Direction.UP:
                tops -= fieldHeight;
                if(tops === fieldHeight + step * fieldHeight)
                {
                    direction = Direction.RIGHT;
                    step +=1;
                }
        
        }
    }       
    
    
    if (boardWidth !== boardHeight) {
        console.log("Divs are not squares! "+fieldWidth+"px / "+fieldHeight+"px");
        console.log("Number of squares to preserve width: " + width/boardWidth*boardHeight);
        console.log("Number of squares to preserve height: " + height/boardHeight*boardWidth);
        
    }
}

function $(id) {
    return document.getElementById(id);
}

var content;

window.onload = function() 
{
    content = $("content");
  //  DrawBoard(10, 7, 1200, 700);
    //DrawBoard(10, 6, 1200, 700);
    DrawBoard(10, 8, 1200, 700);
};
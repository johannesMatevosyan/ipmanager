var rootLink=null;

$(document).ready(function()
{    
    rootLink = $("#rootLink").val();    
});


function existKeyInArray(a,k)
{
    var OutPut = false;
    for (var key in a)
    {
        if(key == k)
        {
            OutPut = true;
            break;
        }
    }
    return OutPut;
}
function countArray(a)
{
    var count = 0;
    for (var k in a)
    {
        if(existKeyInArray(a,k))
            count++;
    }
    return parseInt(count);
}
function empty (mixedValue)
{
     return (mixedValue === undefined ||
          mixedValue === null || mixedValue === ""
          || mixedValue === "0" || mixedValue === 0 
          || mixedValue === false || (Array.isArray(mixedValue)
          && mixedValue.length == 0));
}

function showPopUp(popupBody,style)
{
    $("#universalPopup").trigger("click");
    $("#myModal").html(popupBody);
    $('.modal').attr('style',style);
}



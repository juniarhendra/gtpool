/* ======================================== 
    Document      : ajax.js
    Created on    : Aug 07, 2015
    Author        : Galih U. Syambudhi [galihsam@gmail.com][www.galihsamedia.com]
    Description   : AJAX JS FUNCTION.
=========================================== */

function loadContent()
{
   $('#gsContent').load(site+'/main/home/');
   $('#gsNav').load(site+'/main/gsNav/');
}

function gsLoadContent(page,div){
  $.ajax({
      url: site+"/"+page,
      success: function(response){
          $(div).html(response);
      },
      dataType:"html"     
  });
  $('#gsNav').load(site+'/main/gsNav/'+page);
  return false;
}

function send_form(formObj,action,responseDIV)
{
    $.ajax({
        url: site+"/"+action, 
        data: $(formObj.elements).serialize(), 
        success: function(response){
                $(responseDIV).html(response);
            },
        type: "post", 
        dataType: "html"
    }); 
    return false;
}
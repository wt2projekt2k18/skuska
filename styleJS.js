(function($){
    $(function(){
      $('.sidenav').sidenav();
      $('.collapsible').collapsible();
      $('.tabs').tabs();
      $('.parallax').parallax();
      $('.dropdown-trigger').dropdown({
        //constrainWidth:false,
        //hover:true,
        //coverTrigger:false  
        //gutter:10 //-posunie dropdown o 100px doprava
        //inDuration:1000
        //outDuration:1000
        //alignment:'right'        
      });
      $('select').formSelect();
      $('.modal').modal();
    
  
    }); // end of document ready
  })(jQuery);

  /*var elem = document.querySelector('.collapsible.expandable');
var instance = M.Collapsible.init(elem, {
  accordion: false
});*/

/*var tab = document.getElementsByClassName("tabWrapper");
function displayTab(){
  
  if(tab.style.display === 'none'){
    tab.style.display = 'block';
  }else {
    tab.style.display = 'none';
  }
}*/
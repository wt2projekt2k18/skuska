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
      
    
  
    }); // end of document ready
  })(jQuery);

  /*var elem = document.querySelector('.collapsible.expandable');
var instance = M.Collapsible.init(elem, {
  accordion: false
});*/
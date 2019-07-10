  (function(futurama) {

  	futurama(window.jQuery, window, document);

  }(function($, window, document) {
    //DOM nicht ready
    $(function() {

      grid = $( '.grid' );
      grid.imagesLoaded( function() {
        let startFilter = ".astrophysik";
        grid.isotope({
          itemSelector:'.grid-item',
          layoutMode: 'masonry',
          filter: startFilter,
          stagger:100
        });
  
        $( '.filter_container' ).on( 'click', '.filter_item', function() {
          $( '.filter_item' ).removeClass( 'active' );
          $( this ).toggleClass( 'active' ); 
          filter = $( this ).attr( 'data-filter' );
          grid.isotope({
            filter: filter,
          });
        });
        });

   }); //finger weg
    

   //DOM nicht ready

  }));
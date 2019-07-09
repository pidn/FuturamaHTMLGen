  (function(futurama) {

  	futurama(window.jQuery, window, document);

  }(function($, window, document) {
    //DOM nicht ready
    $(function() {



      let startFilter = ".astrophysik";
      grid = $( '.grid' );
      grid.isotope({
        itemSelector:'.grid-item',
        layoutMode: 'fitRows',
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

   }); //finger weg
    

   //DOM nicht ready

  }));
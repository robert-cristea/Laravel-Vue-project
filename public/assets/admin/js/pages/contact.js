var DataTables = (function () {
  var handleTables = function () {
    $('#contact-datatable').DataTable({
      responsive: true,
      select: true
    })
  }
  var handleLeftSidebar = function () {
    $('.left-sidebar-btn').on('click', function () {
      $('.contact-sidebar').toggleClass('pull-right-side')
      $(this).find('i').toggleClass('icon-fa-angle-right')
      $(this).find('i').toggleClass('icon-fa-angle-left')
    })
  }
  return {
    // main function to initiate the module
    init: function () {
      handleTables()
      handleLeftSidebar()
    }
  }
})();

$(document).ready(function() {
    $('#contact-datatable').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );

jQuery(document).ready(function () {
  //DataTables.init()
})

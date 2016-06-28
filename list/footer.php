	<footer>
      <div style="border-top: 60px solid transparant;" class="container">
        <p style="text-align:center">Mining Hardware Comparison, by <a href="https://bitcointalk.org/index.php?action=profile" target="_blank" rel="author">Heliox</a>. Have a question? An idea? Remarks? <a href="http://webchat.freenode.net/?channels=mininghwcomparison" target="_blank" rel="external">find me on IRC!</a></p>
      </div>
    </footer>

    <script src="http://code.jquery.com/jquery-2.1.3.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="../lib/js/wysihtml5-0.3.0.js"></script>
    <script src="../src/bootstrap3-wysihtml5.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
    <script>
            $(document).ready(function() {

            $('#submitForm').bootstrapValidator({
            framework: 'bootstrap',
            icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
            name: {
            validators: {
            notEmpty: {
            message: 'A manufacturer is required!'
            }
            }
            },
            feature1: {
            validators: {
            notEmpty: {
            message: 'Please fill in a modelname!'
            }
            }
            },
			feature2: {
            validators: {
            notEmpty: {
            message: 'Please fill in a modelname!'
            }
            }
            },
            value_feature2: {
            validators: {
            digits: {
            message: 'Only numbers please'
            },
            notEmpty: {
            message: 'Core clock is required!'
            }
            }
            },
            value_feature3: {
            validators: {
            digits: {
            message: 'Only numbers please'
            },
            notEmpty: {
            message: 'Memory clock is required!'
            }
            }
            },
            value_feature4: {
            validators: {
            notEmpty: {
            message: 'Operating system please..'
            }
            }
            },
            value_feature5: {
            validators: {
            notEmpty: {
            message: 'No drivers? nah, i dont think so'
            }
            }
            },
            value_feature8: {
            validators: {
            notEmpty: {
            message: 'Weird algo...'
            }
            }
            },
            feature5link: {
            validators: {
            url: {
            message: 'Cmon, that is not a valid link'
            }
            }
            },
            value_feature6: {
            validators: {
            notEmpty: {
            message: 'No software = no hash...'
            }
            }
            },
            value_feature9: {
            validators: {
            notEmpty: {
            message: 'it aint going to do that magic without a config..'
            }
            }
            },
            value_feature7: {
            validators: {
            notEmpty: {
            message: 'No point submitting without sharing your hashrate'
            }
            }
            },
            username: {
            validators: {
            notEmpty: {
            message: 'If you do not want to reveal yourself, just type a dot or something..'
            }
            }
            }
    		}
            });
    		});
        </script>
    <script>
        //$('.textarea').wysihtml5();
    	$('.textarea').wysihtml5({
        "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
        "emphasis": true, //Italics, bold, etc. Default true
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        "html": true, //Button which allows you to edit the generated HTML. Default false
        "link": false, //Button to insert a link. Default true
        "image": false, //Button to insert an image. Default true,
        "color": false, //Button to change color of font
        "size": 'sm' //Button size like sm, xs etc.
    });
    </script>
	<script type="text/javascript">
	$(document).ready(function() {
	   $('input[name=base]').click(function() {
		   if (this.id == "radios-0") {
				$("#AMD").show('slow');
			} else {
				$("#AMD").hide('slow');
			}
		});
	});
	
	$(document).ready(function() {
	   $('input[name=base]').click(function() {
		   if (this.id == "radios-1") {
				$("#nVidia").show('slow');
			} else {
				$("#nVidia").hide('slow');
			}
		});
	});
	</script>
    <script type="text/javascript">


		$("#name").change(function() {
			$('#amd').text($('#name :selected').text());
			$('#nvidia').text($('#name :selected').text());
		}).change();


	</script> 
    <script type="text/javascript" charset="utf-8">
        $(prettyPrint);
    </script>
	<script type="text/javascript">
	$('.panel').each(function(i, panel) {
  		$(panel).find('.panel-heading').click(function(e) {
   		 $(e.currentTarget).parent().find('.panel-body').slideToggle();
  		})
	})
	$('[data-toggle="tooltip"]').tooltip();
	$(document).tooltip({
		items:"[title],[data-title]",
		content: function () {
			var element = $(this);
			if ( element.is( "[data-title]" ) ) {
				return element.data("title");
				}
			if ( element.is( "[title]" ) ) {
			   return element.attr( "title" );
				}
			}
	})
	</script>
  <script src="../js/pbTable.js"></script>
  <script type="text/javascript">
      window.alert = function(){};
      var defaultCSS = document.getElementById('bootstrap-css');
      function changeCSS(css){
          if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />');
          else $('head > link').filter(':first').replaceWith(defaultCSS);
      }
      $(document).ready(function() {
        var iframe_height = parseInt($('html').height());
        window.parent.postMessage( iframe_height, 'http://bootsnipp.com');
      });
      $(document).ready(function(e) {
        $('#dev-table').pbTable({
          selectable: true,
          sortable:true,
          toolbar:{
            enabled:false
          }
        });
      });
      $(document).on("click", ".btn", function () {
          var myConfig = $(this).data('id');
          $(".modal-body #configField").html( myConfig );
      });
  </script>
  	<script type="text/javascript">
  (function(){
    'use strict';
  var $ = jQuery;
  $.fn.extend({
    filterTable: function(){
      return this.each(function(){
        $(this).on('keyup', function(e){
          $('.filterTable_no_results').remove();
          var $this = $(this), search = $this.val().toLowerCase(), target = $this.attr('data-filters'), $target = $(target), $rows = $target.find('tbody tr');
          if(search == '') {
            $rows.show();
          } else {
            $rows.each(function(){
              var $this = $(this);
              $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
            })
            if($target.find('tbody tr:visible').size() === 0) {
              var col_count = $target.find('tr').first().find('td').size();
              var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
              $target.find('tbody').append(no_results);
            }
          }
        });
      });
    }
  });
  $('[data-action="filter"]').filterTable();
  })(jQuery);

  $(function(){
    // attach table filter plugin to inputs
  $('[data-action="filter"]').filterTable();

  $('.container').on('click', '.panel-heading span.filter', function(e){
    var $this = $(this),
        $panel = $this.parents('.panel');

    $panel.find('.panel-body').slideToggle();
    if($this.css('display') != 'none') {
      $panel.find('.panel-body input').focus();
    }
  });
  $('[data-toggle="tooltip"]').tooltip();
  })	</script>

</body>
</html>
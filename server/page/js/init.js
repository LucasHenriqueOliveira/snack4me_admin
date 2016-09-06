/* skel-baseline v1.0.1 | (c) n33 | getskel.com | MIT licensed */

(function($) {

	skel.init({
		reset: 'full',
		breakpoints: {

			// Global.
				global: {
					href: 'css/style.css',
					containers: 1400,
					grid: {
						gutters: {
							vertical: '2em',
							horizontal: 0
						}
					}
				},

			// XLarge.
				xlarge: {
					media: '(max-width: 1680px)',
					href: 'css/style-xlarge.css',
					containers: 1200
				},

			// Large.
				large: {
					media: '(max-width: 1280px)',
					href: 'css/style-large.css',
					containers: 960,
					grid: {
						gutters: {
							vertical: '1.5em'
						}
					},
					viewport: {
						scalable: false
					}
				},

			// Medium.
				medium: {
					media: '(max-width: 980px)',
					href: 'css/style-medium.css',
					containers: '90%',
					grid: {
						collapse: 1
					}
				},

			// Small.
				small: {
					media: '(max-width: 736px)',
					href: 'css/style-small.css',
					containers: '90%',
					grid: {
						gutters: {
							vertical: '1.25em'
						}
					}
				},

			// XSmall.
				xsmall: {
					media: '(max-width: 480px)',
					href: 'css/style-xsmall.css',
					grid: {
						collapse: 2
					}
				}

		},
		plugins: {
			layers: {

				// Config.
					config: {
						transform: true
					},

					titleBar: {
						breakpoints: ['small', 'medium'],
						position: 'top-left',
						width: '100%',
						height: 44,
						html: '<div class="title"><a href="#/"><img src="images/logo.png" width="120px" title="Snack4me" /></div>'
					}

			}
		}
	});

	$(function() {
		$(document).ready(function() {
			$("body").on('change','#city', function(){
	            $('#event').empty();
	            var id = $(this).val();
	            if(id > 0){
	            	$.ajax({
						type: "POST",
						url:"call_events.php",
						data: 'city='+ id,
						dataType: "JSON",
						cache: false,
						success:function(result){
							var events = result.response;
							var cmb = '<option value="">Selecione o Evento</option>';
			                $.each(events, function (index, value){
			                    cmb = cmb + '<option value="' + value.id + '|' + value.name + '|' + value.date + '">' + value.name + ' ('+ value.date +')</option>';
			                });
			                $('#event').html(cmb);
				    	},
						beforeSend: function(){
							var cmb = '<option value="">Carregando...</option>';
							$('#event').html(cmb);
					  	}
				    });
	            }
			});
		});
	});

})(jQuery);

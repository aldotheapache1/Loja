			$(document).ready(function()
				{
					$("#btnLogout").click(function()
						{
							$.ajax
							({
								type: 'POST',
								url:'../Scripts/logout.php',
								async: true,
								dataType: 'json',
								success: function(response)
									{
										
										window.setTimeout(function() {
											window.location = '../index.php';
										  }, 1000);
									}
							});
						});
				});
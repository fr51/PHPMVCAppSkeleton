$ (document).ready (function ()
{
	$ ('#button1').click (function ()
	{
		getHomeData ();
	});
});

function getHomeData ()
{
	$.ajax (
	{
		url: 'index.php',
		async: true,
		data: 'route=home/getHomeData&message=plainText',
		dataType: 'json',
		type: 'get',
		success: function (result)
		{
			console.log (result.sampleMessage);
		},
		error: function (result)
		{
			Swal.fire (
			{
				title: "error",
				text: result.responseText,
				icon: "error"
			});
		}
	});
}
$ (document).ready (function ()
{
	$ ('#button1').click (function ()
	{
		postOtherData ();
	});
});

function postOtherData ()
{
	let AJAXData='{\"m\": \"sdf\"}';

	$.ajax (
	{
		url: 'index.php',
		async: true,
		data: 'route=other/postOtherData&message='+AJAXData,
		dataType: 'json',
		type: 'post',
		success: function (result)
		{
			console.log (result.message);
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
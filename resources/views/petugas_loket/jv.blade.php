<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cara Membuat Fungsi Check All Dengan JavaScript</title>
	<style>
        p > a{
        cursor:pointer;	
        }	
        p > a:hover{
        cursor:pointer;
        color: red;	
        }	
	</style>
</head>
<body>
<form id="CekAll" method="post" action="">
  <p><input name="volly" type="checkbox" value="volly" /> Volly</p>
  <p><input name="basket" type="checkbox" value="basket" /> Basket </p>
  <p><input name="bultang" type="checkbox" value="bultang" /> Bulu Tangkis </p>
  <p><input name="renang" type="checkbox" value="renang" /> Renang </p>
  <p><input name="sepaktakrau" type="checkbox" value="sepaktakrau" /> Sepak Takrau </p>
  <p><input name="golf" type="checkbox" value="golf" /> Golf </p>
</form>
<p><a onclick='checkedAll("CekAll");'>Pilih semua</a></p>
</body>
<script type="text/javascript">
var checked=false;
var checkbox='';
function checkedAll(checkbox)
{
    var inputVal= document.getElementById(checkbox);
    if (checked==false)
    {
        checked=true;
    }
    else
    {
        checked = false;
    }
    for (var i =0; i < inputVal.elements.length; i++)
    {
        inputVal.elements[i].checked=checked;
    }
}
</script>	
</html>
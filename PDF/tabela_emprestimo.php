<?php
$pagina .= "
<table cellpadding='0' cellspacing='0'>
	<tr class='row-eqp'>
		<td>Capital</td>
		<td>Total: ".$todos_emp."</td>
	</tr>
	<tr class='row-sub'>
		<td style='border-top: 1px solid rgba(0,0,0,.6)'>Departamento</td>
		<td style='border-top: 1px solid rgba(0,0,0,.6)'>Equipamento - Quantidade</td>
	</tr>
	";
$query = "SELECT unipto, tipo,COUNT(*) AS quantidade 
FROM equipamento e, emprestimo emp, equipamento_emprestado eq 
WHERE  e.num_serie=eq.num_serie and emp.protocolo=eq.protocolo and lot_status=0 and federacao=0
GROUP BY unipto, tipo";

$result = mysqli_query($conn,$query);
while ($rs = mysqli_fetch_object($result))
{
$pagina .="
	<tr class='centro'>
		<td>".$rs->unipto."</td>
		<td>".$rs->tipo." - ".$rs->quantidade."</td>
	</tr>";
}
$pagina .= "
</table>
<br>";

$pagina .= "
<table cellpadding='0' cellspacing='0'>
	<tr class='row-eqp'>
		<td>Interior</td>
		<td>Total: ".$todos_emp_i."</td>
	</tr>
	
	<tr class='row-sub'>
		<td style='border-top: 1px solid rgba(0,0,0,.6)'>Unidade</td>
		<td style='border-top: 1px solid rgba(0,0,0,.6)'>Equipamento - Quantidade</td>
	</tr>
	";
$query = "SELECT unipto, tipo,COUNT(*) AS quantidade 
FROM equipamento e, emprestimo emp, equipamento_emprestado eq 
WHERE  e.num_serie=eq.num_serie and emp.protocolo=eq.protocolo and lot_status=0 and federacao=1
GROUP BY unipto, tipo";

$result = mysqli_query($conn,$query);
while ($rs = mysqli_fetch_object($result))
{
$pagina .="
	<tr class='centro'>
		<td>".$rs->unipto."</td>
		<td>".$rs->tipo.": ".$rs->quantidade."</td>
	</tr>";
}
$pagina .= "
</table>
";

?>
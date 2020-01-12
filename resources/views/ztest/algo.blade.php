	<html>
<head>
<style type="text/css">
table, td, th {
  border: 1px solid black;
}


table {
  border-collapse: collapse;
  
}
td,th{
	width:30px;
	height:30px;
	text-align:center;
	line-height:30px;
}
td {
  vertical-align: bottom;
}
  </style>
</head>
<body>
<?php
$text =   "-bk2341ea--bk2312ze--bk2$00ne--bk123z--bk2323ee--bk2212--bke510--ek1000nk-";
$patern = "-bk1000nk-";
$text1=  "bacxybaabababaxbaacaabacxaba";
$mark1=0;
$mark2=0;
$patern1="bacxaba";
$texted =  "bacxeacbacxbac";
$paterned ="bacxbac";
$patern1 ="bacxaba";
$textarr = str_split($text);
$paternarr = str_split($patern);
$paternarr1 = str_split($patern1);
$textlength = count($textarr);
$totalc=0;
$paternlength = count($paternarr);
$num = 0;
$status = '';
$marki=0;
$total = 0;
$maret = -2;
$ind = 0 ;
$markermargin=0;

$pat = $paternlength-1;
$i = $paternlength -1 ; /*text iterator */
$j = $paternlength -1 ; /*pattern iterator */
$h1 = $paternlength-1;
$step = 1;
$q1=0;
$q2=0;
$q2=$q2+$h1;
/*Pattern Table */
/*Occurance Table */
$ocindex = array();
$jj = 0 ;
for($ii=0 ;$ii<$paternlength;$ii++)
{
	$ocindex[$ii] = -1;
	if($ii != 0 ){
		for($jj=0 ;$jj<$ii;$jj++)
		{
			if($paternarr[$ii] == $paternarr[$jj] && $ii != $jj){
				$ocindex[$ii] = $jj;
			}				
		}		
	}	
}
$margintable = array();
$jc= 0;
$jarak=0;
$tc = 0;
$iz1=0;
/*Menetentukan Kondisi MarginTable Untuk Panjang Text ganjil atau genap */
if($paternlength % 2 == 1){
	$jc = ($paternlength/2) - 0.5;
	$jarak = $jc + 1;
}
else{
	$jc = ($paternlength/2);
	$jarak = $jc ;
}
/*Margin Table*/
while($jc > 0 ){
	$tc = 0 ;
	for ($iz=0;$iz<$jc;$iz++){
		$iz1=0;
		$iz1= $iz + $jarak;

		if ($paternarr[$iz] == $paternarr[$iz1]){
			$tc = $tc+1;
		}
	}
	if ($tc == $jc)
	{
		$jc = 0;
	}
	$jc -- ;	
	$jarak ++;
}

for($zz= 0 ; $zz < $paternlength ; $zz++){

	if ($zz >= ($paternlength-$tc)){
		$margintable[$zz] = 0;
	}
	else{
		$margintable[$zz] = $tc; 
	}
}
echo "Pattern :" ;
echo "</br>";
echo "<table>";
echo "<tr>";
echo "<th>";
echo  "j";
echo "</th>";

for($zze=0;$zze<count($margintable);$zze++){
	echo "<th>";
	echo  $zze;
	echo "</th>";

}
echo "</tr>";

echo "<tr>";
echo "<th>";
echo  "P[j]";
echo "</th>";
for($zze=0;$zze<count($margintable);$zze++){
	
	echo "<td>";
	echo  $paternarr[$zze];
	echo "</td>";	
}
echo "</tr>";
echo "</table>";
echo "</br>";
echo "<table>";
echo "<tr>";
/*Margin */
echo "Margin Table :" ;
echo "</br>";
echo "<table>";
echo "<tr>";
echo "<th>";
echo  "j";
echo "</th>";
for($zze=0;$zze<count($margintable);$zze++){
	echo "<th>";
	echo  $zze;
	echo "</th>";

}
echo "</tr>";

echo "<tr>";
echo "<th>";
echo  "MarginTable[j]";
echo "</th>";
for($zze=0;$zze<count($margintable);$zze++){
	echo "<td>";
	echo  $margintable[$zze] ;
	echo "</td>";	
}
echo "</tr>";
echo "</table>";
echo "</br>";
echo "<table>";
echo "<tr>";
echo "Occurance Table :";
echo "</br>";
echo "<th>";
echo  "j";
echo "</th>";
for($zze=0;$zze<count($margintable);$zze++){
	echo "<th>";
	echo $zze ;
	echo "</th>";
}
echo "</tr>";
echo "<tr>";
echo "<th>";
echo  "Occurance[j]";
echo "</th>";
for($zze=0;$zze<count($margintable);$zze++){
	echo "<td>";
	echo $ocindex[$zze];
	echo "</td>";
}
echo "</tr>";
echo "</table>";
echo "</br>";
/*Text Table*/
echo '<div class="header1">';
echo "Text Table :" ;
echo "</br>";
echo "<table>";
echo "<tr>";
echo "<th>";
echo  "j";
echo "</th>";

for($zze=0;$zze<$textlength;$zze++){
	echo "<th>";
	echo  $zze;
	echo "</th>";

}
echo "</tr>";

echo "<tr>";
echo "<th>";
echo  "P[j]";
echo "</th>";
for($zze=0;$zze<$textlength;$zze++){
	echo "<td>";
	echo  $textarr[$zze];
	echo "</td>";	
}
echo "</tr>";
echo "</table>";
echo "</br>";

echo '</div>';
while($j>= 0 && $i < $textlength){	
	if ($textarr[$i] == $paternarr[$j]){
		if ($j == $paternlength-1){
			$marki = $i;
		}
		
		$i--; $j--;$total ++ ;
	
		
	}
	else{
		$total++;
		$totalc=$total;
		
		$numofmatch = 0;
		if($j == $h1){
			$marki = $i;
		}
		$mark1=$i;
		$mark2=$marki;
		echo "Mark1:".$mark1."-"."Mark2:".$mark2;
		echo "</br>";
		$markermargin = $margintable[$j];
		
		echo "Step".$step;
		
		echo "</br>";
		
		echo "Index :" . $marki;
		echo "</br>";
		echo "Text Table :" ;
		echo "</br>";
		echo "<table>";
		echo "<tr>";
		echo "<th>";
		echo  "j";
		echo "</th>";
			
	for($zze=0;$zze<$textlength;$zze++){	
		echo "<th>";
		echo  $zze;
		echo "</th>";

	}
	echo "</tr>";

	echo "<tr>"; 
	echo "<th>";
	echo  "P[j]";
	echo "</th>";
	for($zze=0;$zze<$textlength;$zze++){
		
		echo "<td>";
		echo  $textarr[$zze];
		echo "</td>";	
	}
	echo "</tr>";
	echo "<tr>"; 
	echo "<th>";
	echo  "pattern";
	echo "</th>";
	for($zze=0;$zze<$textlength;$zze++){
		if($zze >= $q1 && $zze <=$q2){
			if($ind == $paternlength){
				$ind = 0 ;
			}
			echo "<td>";
			echo  $patern[$ind];
			echo "</td>";
			$ind = $ind+1;
			}
		else{
			echo "<td>";
			echo  " " ;
			echo "</td>";
		}
			
	}
	
	echo "</tr>";
	echo "<tr>"; 
	echo "<th>";
	echo  "Comparison";
	echo "</th>";
	for($zze=0;$zze<$textlength;$zze++){
		if($zze >= $mark1 && $zze <=$mark2){
		if($zze == $maret || $zze == $maret-1)
			{
				echo "<td>";
				echo  " " ;
				echo "</td>";
			}
			else{
				echo "<td>";
				echo  $totalc;
				echo "</td>";
				$totalc--;
			}
		
	
			}
		else{
			echo "<td>";
			echo  " " ;
			echo "</td>";
		}
			
	}
	echo "</tr>";
	echo "</table>";
	echo "</br>";
	
		$step++;
		$g = $j;
		$loncat = 0;
		$pairedakhir = $textarr[$i];
		if($j == 0){
			$pairedawal= " ";
		}
		else{
			$pairedawal = $textarr[$i-1];
		}
	
		$mar = 0;
		$unmatch = '';
		while($g >= 0 ){			
			$text = $paternarr[$g];
			$unmatch = $unmatch.$text;
			$g=$g-1;
		}
		/*Membalikan String Dan Memecah Menjadi Array*/
		$unmatch1=strrev($unmatch);
		$unmatched = str_split($unmatch1);
		$unmatchlength = count($unmatched);
		if(count($unmatched) == $paternlength){
			array_pop($unmatched);
		}
		/*Mencetak Data Paired*/
		if($j == 0){
			echo "Tidak Ada Paired";
		}
		else{
			echo "Paired :".$pairedawal.$pairedakhir;
		}	
		echo "</br>";
		echo "Unmatched :";
		for($iii=0  ; $iii<count($unmatched);$iii++){
			echo $unmatched[$iii];
		}
		/*Mencari char dari Occurance Table*/
		$indexakhir = -1;
		$indexawal = -2;
		$ale = count($unmatched);
		echo "</br>";
	
			
		for($y=0 ;$y<$ale;$y++){
				
			if ($unmatched[$y] == $pairedakhir){			
				 $indexakhir = $y;/*Index Occurance Table Akhir Muncul*/
				 $indexawal = $y-1;
				 $temp = $ocindex[$y];		
			
			}	
		}
		$ab = $indexakhir;
		/*Menetukan Paired Atau Tidak */
		$marker= 0 ;
		while($ab > -1){
				
			if($ab == 0)
			{
				$de = " ";
			}
			else{
				$de = $unmatched[$ab-1];
			}
			if($de == $pairedawal && $unmatched[$ab] == $pairedakhir && $ab ){
				$mar = 2 ;		
				$marker= $ab;
				$ab = 0;			
			}	
			else if ($unmatched[0] == $pairedakhir && $ab == 0 ){
				$mar = 	1;
				$ab = 0;	
			}
					
			$temp = $ocindex[$ab];
			$ab = $temp;
		}
		
		if($mar != 0){
			if($mar == 2){
				echo "Match Jump";
				$loncat = count($unmatched);
				$numofmatch = 2;
				$maret = $i;
				$i = $marki + $unmatchlength-1 - $marker ;		
				echo "</br>";
	
				echo "Jump Ke Index: " . $i;
				$j = $paternlength-1;
				$q2= $i;
				$q1= $q2-$j;
				echo "</br>";
				echo "</br>";
			}
			else if($mar == 1){
				echo "Single Match";
				$loncat = 
				$i = $marki+$unmatchlength-1;			
				echo "</br>";
				echo "Jump ke Index 	: " . $i;
				$j = $paternlength-1;
				$q2= $i;
				$q1= $q2-$j;
				echo "</br>";
				echo "</br>";
			}
		}
		else if($markermargin != 0){
				$loncat = $paternlength-$markermargin;
				$maret =  $marki;
				
				$numofmatch = $margintable[0];
				echo "Margin Jump";	
				$i = $marki + $loncat;
				echo "</br>";				
				echo "Jump Ke Index: " . $i;
				$j = $paternlength-1;	
				$q2= $i;
				$q1= $q2-$j;				
				echo "</br>";
				echo "</br>";
			}
		else{
				$loncat = count($paternarr);
				echo "Full Jump";
				$i = $marki+$loncat;
				echo "</br>";
				echo "Jump Ke Index : " . $i;
				$j = $paternlength-1;
				$q2= $i;
				$q1= $q2-$j;
				echo "</br>";
				echo "</br>";
			}
		}
		/*Avoid Double Comparison */
		
		if ($i == $maret){
			$i = $i - $numofmatch;
			$j = $j - $numofmatch;
				
		}
		
	
	}
	

echo "</br>";
$totalc=$total;
if($j == -1 )
{
	echo "Ada";
}
else{
	echo "tidak ada";
}

echo "</br>";
if($textlength < $i){
echo "Text Table :" ;
		echo "</br>";
		echo "<table>";
		echo "<tr>";
		echo "<th>";
		echo  "j";
		echo "</th>";

	for($zze=0;$zze<=$i;$zze++){	
		echo "<th>";
		echo  $zze;
		echo "</th>";

	}
	echo "</tr>";

	echo "<tr>"; 
	echo "<th>";
	echo  "P[j]";
	echo "</th>";
	for($zze=0;$zze<=$i;$zze++){
		if($zze < $textlength){
			echo "<td>";
			echo  $textarr[$zze];
			echo "</td>";	
		}	
	}
	echo "</tr>";
	echo "<tr>"; 
	echo "<th>";
	echo  "pattern";
	echo "</th>";
	for($zze=0;$zze<=$i;$zze++){
		if($zze >= $q1 && $zze <=$q2){
			if($ind == $paternlength){
				$ind = 0 ;
			}
			echo "<td>";
			echo  $patern[$ind];
			echo "</td>";
			$ind = $ind+1;
			}
		else{
			echo "<td>";
			echo  " " ;
			echo "</td>";
		}
			
	}
	echo "</tr>";
	echo "</table>";
	}
else{
echo "Text Table :" ;
		echo "</br>";
		echo "<table>";
		echo "<tr>";
		echo "<th>";
		echo  "j";
		echo "</th>";

	for($zze=0;$zze<$textlength;$zze++){	
		echo "<th>";
		echo  $zze;
		echo "</th>";

	}
	echo "</tr>";

	echo "<tr>"; 
	echo "<th>";
	echo  "P[j]";
	echo "</th>";
	for($zze=0;$zze<$textlength;$zze++){
		
		echo "<td>";
		echo  $textarr[$zze];
		echo "</td>";	
	}
	echo "</tr>";
	echo "<tr>"; 
	echo "<th>";
	echo  "pattern";
	echo "</th>";
	for($zze=0;$zze<$textlength;$zze++){
		if($zze >= $q1 && $zze <=$q2){
			if($ind == $paternlength){
				$ind = 0 ;
			}
			echo "<td>";
			echo  $patern[$ind];
			echo "</td>";
			$ind = $ind+1;
			}
		else{
			echo "<td>";
			echo  " " ;
			echo "</td>";
		}
			
	}
	echo "</tr>";
	echo "<tr>"; 
	echo "<th>";
	echo  "Comparison";
	echo "</th>";
	
	for($zze=0;$zze<$textlength;$zze++){
		if($zze > $i && $zze <=$marki){
			if($zze == $maret || $zze == $maret-1){
				echo "<td>";
				echo  " " ;
				echo "</td>";
			}
			else{
				echo "<td>";
				echo  $totalc;
				echo "</td>";
				$totalc--;
			}
		
	
			}
		else{
			echo "<td>";
			echo  " " ;
			echo "</td>";
		}
			
	}
	echo "</tr>";
	echo "</table>";
}
echo "</br>";
echo "Jumlah Perbandingan : " .  $total;

		
?>
</body>
</html>